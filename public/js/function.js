/**
 * List function use in view
 * @author ThieuLM
 */

/**
 * @param obj
 * @param dataUrl
 * @param callback
 */
function ajaxGet(dataUrl, callback = 'defaultCallbackAjaxGet') {
    ajax(dataUrl, {}, callback);
}

/**
 * @param dataUrl
 * @param dataReq
 * @param callback
 * @param dataTypeAjax
 * @param loadingObj
 */
function ajaxPost(dataUrl, dataReq, callback, dataTypeAjax = 'json', loadingObj = null) {
    ajax(dataUrl, dataReq, callback, 'POST', dataTypeAjax, loadingObj);
}

/**
 * @param dataUrl
 * @param dataReq
 * @param callback
 * @param dataTypeAjax
 * @param loadingObj
 */
function ajaxPut(dataUrl, dataReq, callback, dataTypeAjax = 'json', loadingObj = null) {
    ajax(dataUrl, dataReq, callback, 'PUT', dataTypeAjax, loadingObj);
}

/**
 * @param dataUrl
 * @param dataReq
 * @param callback
 * @param dataTypeAjax
 * @param loadingObj
 */
function ajaxDelete(dataUrl, dataReq, callback, dataTypeAjax = 'json', loadingObj = null) {
    ajax(dataUrl, dataReq, callback, 'DELETE', dataTypeAjax, loadingObj);
}

/**
 *
 * @param dataResponse
 */
function defaultCallbackAjaxGet(dataResponse) {
    let dataContent = dataResponse;
    let objModal = $('#js-block-modal');
    objModal.find('.modal-body').html(dataContent);
    objModal.modal('show');
}

function ajax(dataUrl, dataReq, callback, typeAjax = 'GET', dataTypeAjax = 'html', loadingObj = null) {
    let e = event;
    if (e.target.hasAttribute('disabled')) return;
    $.ajax({
        url: dataUrl,
        type: typeAjax,
        dataType: dataTypeAjax,
        data: dataReq,
        beforeSend: function () {
            e.target.setAttribute('disabled', 'disabled');
            if (loadingObj) {
                $(loadingObj).removeClass('hidden');
            }
        },
        success: function (dataResponse) {
            if (typeof callback === 'function') {
                callback (dataResponse)
            } else if (typeof callback === 'string' && typeof window[callback] === 'function') {
                window[callback](dataResponse);
            } else { // call default callback
                console.log('Cannot find ' + dataResponse + ', Call default callback: defaultCallbackAjax');
                defaultCallbackAjax(dataResponse);
            }
        },
        error: function (a, b, c) {
            console.log(a + b + c);
        },
        complete: function () {
            e.target.removeAttribute('disabled');
            if (loadingObj) {
                $(loadingObj).addClass('hidden');
            }
        }
    });
}
function defaultCallbackAjax(dataResponse) {

}

/**
 * Show list cross check item when click
 * @param dataUrl
 */
function showCrossCheckItems(dataUrl) {
    let e = event;
    e.preventDefault();
    if (!dataUrl) dataUrl = e.target.href;
    if (typeof window['ajaxGet'] === 'function') {
        ajaxGet(dataUrl, (dataRes) => {
            let dataContent = dataRes;
            let objModal = $('#js-block-modal');
            objModal.find('.modal-title').html('<b>Chi tiết phiếu đối soát: </b> ' + e.target.innerText);
            objModal.find('.modal-body').html(dataContent);
            objModal.modal('show');
        });
    }
}

function reTryv3PushToKv(crossCheckId){
    $.ajax({
        url: '/v3/push-cross-check-to-kv' + '/' + crossCheckId,
        type: "get",
        success: function (resp) {
            console.log(resp);
            if (resp.status == 'success') {
                //self.parent().parent().addClass('warning');
                //self.parent().parent().find('.label-primary').text('In progress');

                $.toaster({
                    message: 'Tạo yêu cầu gửi đối soát sang kiotviet thành công',
                    title: 'Thông báo',
                    priority: 'success'
                });

            } else {
                processApprove = true;
                $.toaster({message: "Xảy ra lỗi", title: 'Thông báo', priority: 'danger'});
            }
        },
        error: function (resp) {
            resp = resp.responseJSON;
            $.toaster({message: resp.message, title: 'Thông báo', priority: 'danger'});
        }
    });
}
