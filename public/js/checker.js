var CheckerPage = CheckerPage || function (page, filePath) {
    var me = this;
    var rABS = true; // true: readAsBinaryString ; false: readAsArrayBuffer
    var extFileSupport = ['xlsx', 'xls'];

    var elements = {
        'frmChecker' : '#frmChecker',
        'inputSelectFile' : '#checkerFile',
        'siteToken' : 'input[name="_token"]',
        'tabChecker' : '#tab-checker',
        'labelExportChecker' : '.exportChecker',
        'jointTableBody' : '#jointTableBody',
        'deviationTableBody' : '#deviationTableBody',
        'alertErrorUpload' : '#errorUploadFile',
        'jointCount' : '.jointCount',
        'deviationCount' : '.deviationCount',
        'checkerCount' : '.checkerCount',
        'jointNum' : '.jointNum',
        'totalMoney' : '#totalMoney',
        'btnExportChecker' : '#btnExportChecker',
        'btnSave' : '#btnSave',
        'btnFinish' : '#btnFinish',
        'lblLadingType' : '.lading-type',
        'inputChooseChecker' : '.chooseChecker',
        'inputChooseCheckerChecked' : '.chooseChecker:checked',
        'inputJointLadings': 'input[name="ladings[]"]',
        'ladingsCheckedStatus': '#ladingsCheckedStatus',
        'incomeTableBody': '#incomeTableBody',
        'expenditureTableBody': '#expenditureTableBody',
        'equalTableBody': '#equalTableBody',
        'countChecker': '.countChecker',
        'totalChecked': '.totalChecked',
        'totalIncome': '.totalIncome',
        'totalExpenditure': '.totalExpenditure',
        'equalCount': '.equalCount',
        'checkerRow': '.checker-row',
    };

    /* Element getter */
    function elm(name){
        return $(elements[name]);
    }

    var validationForm = function (file, cbDone, cbError) {
        var filename = elm('inputSelectFile').val().split('\\').pop();
        var ext = filename.split('.').pop();

        if ($.inArray(ext, extFileSupport) === 0){
            cbDone();
        } else {
            cbError();
        }
    };

    var readSheetContent = function (workbook, cbDone) {
        var first_sheet_name = workbook.SheetNames[0];
        var worksheet = workbook.Sheets[first_sheet_name];
        var codeColumn = "C";
        var valueColumn = "R";
        var firstRow = "9";
        var result = [];

        do {
            var codeDesiredCell = worksheet[codeColumn + firstRow];
            var valueDesiredCell = worksheet[valueColumn + firstRow];
            var code = codeDesiredCell ? codeDesiredCell.v : undefined;
            var value = valueDesiredCell ? valueDesiredCell.v : undefined;

            if (code !== undefined){
                result[code] = value;
            }
            firstRow++;
        }
        while (value !== undefined);

        cbDone(result);
    };

    var getDataFromServer = function (codeList, cbDone) {
        var token = elm('siteToken').val();
        $.ajax({
            type: 'post',
            url: '/checkers/match-data',
            data: {_token: token, codeList: JSON.stringify(codeList)},
            dataType: 'JSON',
            success: function (data) {
                cbDone(data);
            }
        });
    };

    var calculateMatchData = function (codeList, data, ladingType, cbDone) {
        var billLadings = data['ladings'];
        var status = data['status'];
        cleanCheckerTableData();
        var jointCount = 0;
        var deviationCount = 0;

        elm('tabChecker').show();
        elm('labelExportChecker').removeClass('hide');

        $.each(billLadings, function (index, billLading) {
            // elm('tabChecker').show();
            // elm('labelExportChecker').removeClass('hide');
            if ((billLading[ladingType] === codeList[billLading['code']]) && ($.inArray(billLading['kv_status'], [3,5]) == 0)){
                var htmlJointRow = "<tr class='checker-row'><td><i class='fa fa-check'></i></td><td>" + billLading['code'] + "</td><td>" + billLading['shop']['code'] + "</td><td>" + status[billLading['code']] + "</td><td class='jointNum'>" + billLading[ladingType] + "</td></tr>";
                var inputLadings = "<input type='text' class='hide' name='ladings[]' value='" + billLading['id'] + "'>";
                elm('frmChecker').append(inputLadings);
                elm("jointTableBody").append(htmlJointRow);
                delete codeList[billLading['code']];
                jointCount++;
            } else {
                var htmlDeviationRow = "";
                // Check billLadings status
                var codeFromFile = '--';
                if (billLading[ladingType] !== undefined)
                    codeFromFile = billLading[ladingType];
                htmlDeviationRow = "<tr class='checker-row'><td><i class='fa fa-close'></i></td><td>" + billLading['code'] + "</td><td>"+ billLading['code'] +"</td><td>" + billLading['shop']['code']+ "</td><td>" + status[billLading['code']] + "</td><td>" + codeList[billLading['code']] + "</td><td>" + codeFromFile + "</td></tr>";

                elm("deviationTableBody").append(htmlDeviationRow);
                delete codeList[billLading['code']];
                deviationCount++;
            }
        });

        // add missing billLadings code to deviation table
        for (var code in codeList) {
            var htmlDeviationRow = "<tr class='checker-row'><td><i class='fa fa-close'></i></td><td>" + code + "</td><td>--</td><td>--</td><td>--</td><td>" + codeList[code] + "</td></td><td>--</td></tr>";
            elm("deviationTableBody").append(htmlDeviationRow);
            deviationCount++;
        }
        // Check available to finish
        if ((jointCount > 0) && (deviationCount === 0)){
            elm('btnFinish').removeAttr('disabled');
            elm('ladingsCheckedStatus').val(1);
        } else {
            elm('btnFinish').attr('disabled', 'disabled');
            elm('ladingsCheckedStatus').val(0);
        }

        elm('jointCount').html(jointCount);
        elm('deviationCount').html(deviationCount);
        elm('checkerCount').html(jointCount + deviationCount);
        cbDone();
    };

    var cleanCheckerTableData = function () {
        elm('checkerRow').each(function () {
            $(this).remove();
        });
        elm('inputJointLadings').each(function () {
           $(this).remove();
        });

        elm('tabChecker').hide();
        if (!elm('labelExportChecker').hasClass('hide')){
            elm('labelExportChecker').addClass('hide')
        }
    };

    var loadOldData = function () {
        var xhr = new XMLHttpRequest();
        var ladingType = elm('lblLadingType').attr('lading-type');
        xhr.open("GET", filePath, true);
        xhr.overrideMimeType('text\/plain; charset=x-user-defined');
        xhr.onload = function(e) {
            var data = xhr.responseText;
            // dummyObject
            var f = new File([], 'sample.xlsx', {type:'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});

            var reader = new FileReader();
            reader.onload = function(e) {
                var projectTime = {};
                var workbook = XLSX.read(data, {type: 'binary'});

                readSheetContent(workbook, function (res) {
                    getDataFromServer(Object.keys(res), function (data) {
                        calculateMatchData(res, data, ladingType, function () {
                            //    Calculate total money
                            var totalJoinNum = 0;
                            elm('jointNum').each(function () {
                                totalJoinNum += parseFloat($(this).html());
                            });
                            elm('totalMoney').html(totalJoinNum);
                        });
                    });
                });
            };
            reader.readAsBinaryString(f);
        };
        xhr.send(null);
    };

    var eventHandles = {
        readExcelFile: function(e){
            var files = e.target.files, f = files[0];
            validationForm(files, function () {
                var reader = new FileReader();
                var ladingType = elm('inputSelectFile').attr('lading-type');
                reader.onload = function(e) {
                    // Read file
                    var data = e.target.result;
                    if(!rABS) data = new Uint8Array(data);
                    var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});

                    readSheetContent(workbook, function (res) {
                        getDataFromServer(Object.keys(res), function (data) {
                            calculateMatchData(res, data, ladingType, function () {
                                //    Calculate total money
                                var totalJoinNum = 0;
                                elm('jointNum').each(function () {
                                    totalJoinNum += parseFloat($(this).html());
                                });
                                elm('totalMoney').html(totalJoinNum);
                            });
                        });
                    });
                };
                if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
            }, function () {
                elm('alertErrorUpload').show().fadeOut(5000);
                elm('inputSelectFile').val('');
            });
        },
        exportChecker: function (e) {
            e.preventDefault();
            var wb = XLSX.utils.book_new();

            wb.Props = {
                Title: "Checker result",
                Subject: "Checker result",
                Author: "OPSS of Citigo",
                CreatedDate: new Date(2017,12,19)
            };

            var jointWbData = getTableData(elm('jointTableBody'));
            wb = add_data_to_workbook(wb, jointWbData, "Khớp");

            var deviationWbData = getTableData(elm('deviationTableBody'));
            wb = add_data_to_workbook(wb, deviationWbData, "Lệch");

            XLSX.writeFile(wb, "test.xlsx");
        },
        chooseChecker: function () {
            var checkerList = [];
            elm('inputChooseCheckerChecked').each(function () {
                checkerList.push($(this).attr('checker-id'));
            });

            getShopList(checkerList, function (shopsList) {
                cleanCheckerTableData();
                var incomeCount = 0;
                var incomeTotal = 0;
                var expenditureCount = 0;
                var expenditureTotal = 0;
                var totalShopChecked = 0;
                var equalCount = 0;
                $.each(shopsList, function (index, shopArr) {
                    var shopTotal = parseFloat(shopArr['cod']) - parseFloat(shopArr['fee']);
                    if (shopTotal > 0){
                        //    Income
                        var incomeHtml = '<tr class="checker-row"><td><input type="checkbox"></td><td>' + shopArr['name'] + '</td><td><a>'+ shopArr['ladings'].length +'</a></td><td>'+ shopArr['cod'] +'</td><td>'+ shopArr['fee'] +'</td><td>' + shopTotal + '</td></tr>';
                        elm('incomeTableBody').append(incomeHtml);
                        incomeCount++;
                        incomeTotal += shopTotal;
                    } else{
                        if (shopTotal < 0){
                            //    Expenditure
                            var expenditureHtml = '<tr class="checker-row"><td><input type="checkbox"></td><td>' + shopArr['name'] + '</td><td><a>'+ shopArr['ladings'].length +'</a></td><td>'+ shopArr['cod'] +'</td><td>'+ shopArr['fee'] +'</td><td>' + -shopTotal + '</td></tr>';
                            elm('expenditureTableBody').append(expenditureHtml);
                            expenditureCount++;
                            expenditureTotal += shopTotal;
                        } else {
                            //    not income and not expenditure (cod == fee)
                            var equalHtml = '<tr class="checker-row"><td><input type="checkbox"></td><td>' + shopArr['name'] + '</td><td><a>'+ shopArr['ladings'].length +'</a></td><td>'+ shopArr['cod'] +'</td><td>'+ shopArr['fee'] +'</td><td>' + -shopTotal + '</td></tr>';
                            elm('equalTableBody').append(equalHtml);
                            equalCount++;
                        }
                    }
                    totalShopChecked++;
                });
                elm('countChecker').html(checkerList.length);
                elm('totalChecked').html(totalShopChecked);
                elm('totalIncome').html(incomeCount);
                elm('equalCount').html(equalCount);
                elm('totalExpenditure').html(expenditureTotal);
            });
        }
    };

    function getShopList(checkerList, cbDone) {
        var token = elm('siteToken').val();

        $.ajax({
            type: 'post',
            url: '/checkers/get-shop-list',
            data: {_token: token, checkerList: JSON.stringify(checkerList)},
            dataType: 'JSON',
            success: function (data) {
                cbDone(data);
            }
        });
    }

    function getTableData(tableObj) {
        var data = [];
        var header = [];

        tableObj.find('tr').find('th').each(function (i, v) {
            if (i !== 0)
                header.push($(this).text());
        });
        data.push(header);

        tableObj.find('tr').each(function (rowIndex, rowValue) {
            var rowData = [];
            $(this).find('td').each(function (cellIndex, cellValue) {
                if (cellIndex !== 0){
                    rowData.push($(this).text());
                }
            });
            data.push(rowData);
        });
        return data;
    }

    function add_data_to_workbook(wb, ws_data, sheetName) {
        wb.SheetNames.push(sheetName);
        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        wb.Sheets[sheetName] = ws;

        return wb;
    }

    function bindEvents() {
        var hd = eventHandles;
        elm('inputSelectFile').change(function (e) {
            hd.readExcelFile(e);
        });
        // $(document).on('click', elements['btnSave'], hd.saveChecker);
        $(document).on('click', elements['btnExportChecker'], hd.exportChecker);
        $(document).on('click', elements['inputChooseChecker'], hd.chooseChecker);
    }

    function init() {
        bindEvents();

        if (filePath !== undefined){
            if ((page=='show' || page == 'edit') && filePath !== undefined)
                loadOldData();
        }
    }

    init();

    return{

    };
};