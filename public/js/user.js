var UserPage = UserPage || function (page) {
    var me = this;

    var elements = {
        'txtSearchText': '#txtSearchText',
        'searchForm': '#searchForm',
        'searchRole': '#searchRole',
        'searchStatus': '.searchStatus',
    };

    /* Element getter */
    function elm(name){
        return $(elements[name]);
    }

    var eventHandles = {
        submitSearchForm: function (){
            elm('searchForm').submit();
        },
        filterRole: function () {
            eventHandles.submitSearchForm();
        },
        filterStatus: function () {
            eventHandles.submitSearchForm();
        }
    };

    function bindEvents() {
        var hd = eventHandles;
        //
        $(document).on('change', elements['searchRole'], hd.filterRole);
        $(document).on('click', elements['searchStatus'], hd.filterStatus);

        elm('txtSearchText').keyup(function(e){
            if(e.keyCode == 13)
            {
                hd.submitSearchForm();
            }
        });
    }

    function init() {
        bindEvents();
    }

    init();

    return{

    };
};