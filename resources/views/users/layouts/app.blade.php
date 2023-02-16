<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle') {{!empty($pageHeader) ? $pageHeader : 'Kiotviet Giao Van'}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('templates/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/select2/dist/css/select2.min.css')}}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet"
          href="{{asset('templates/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{asset('templates/adminlte/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
                @yield('content')
</div>
<script src="{{asset('templates/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('templates/adminlte/dist/js/adminlte.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-notify-master/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-notify-master/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('js/jquery.toaster.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('templates/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script>
    $(function () {
        let ticketPopupValue = '{{ session('ticketPopup') }}';

        if (ticketPopupValue == true){
            $('#modal-ticket').modal('show');
        }
        if ('{{ session('synchronized-permission') }}') {
            let synced_permission =  JSON.parse('{{ session('synchronized-permission') }}'.replace(/&quot;/g,'"'));
            if (synced_permission && synced_permission.synchronized) {
                $.toaster({settings: {'timeout': 4000}});
                $.toaster({message: 'Permission ' + synced_permission.route_name + ' cho guard ' + synced_permission.guard_name + ' đã được thêm mới. Vui lòng truy cập trang quản lý người dùng để kích hoạt.' , title: 'Thông báo', priority: 'success'});
                {{ session()->forget('synchronized-permission') }}
            }
        }

        let ticketCheckbox = $('#ticketPopup');
        // ticketCheckbox.change(function () {
        //     if ($(this).is(":checked")) {
        //         ticketPopup('off');
        //     } else {
        //         ticketPopup('on');
        //     }
        // });

        ticketCheckbox.click(function () {
            ticketPopup('off');
        });

        $('form.ajax-submit').submit(function (e) {
            e.preventDefault();

            var isSubmit = $(this).attr('is-submit');
            if (isSubmit !== 'true') {
                $(this).attr('is-submit', 'true');
                var $this = $(this);
                var url = $this.attr('action');
                var method = $this.attr('method');
                var data = $this.serialize();
                var handle = $this.attr('handle');

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function (resp) {
                        if (resp.status === 'success') {
                            if (handle === 'alert') {
                                alert(resp.msg);
                                window.location.reload();
                            } else if (handle == 'reload') {
                                window.location.reload();
                            }
                        }
                    }
                });
            } else {
                alert('Please wait');
            }
        });
    });

    function ticketPopup(status) {
        $.ajax({
            type: 'get',
            url: '{{ url('/') }}',
            data: {
                status: status
            },
            dataType: 'json',
            success: function (resp) {
                if (status === 'off'){
                    $('#modal-ticket').modal('toggle');
                }
            }
        });
    }

    function formatNumber(value) {
        let val = (value / 1).toFixed(0).replace(".", ",");
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "click",
            html: true,
            animateIn: 'slideDown',
            animateOut: 'slideUp',
            target: '#popover',
        });
        let body = $('body');
        body.on('click', function (e) {
            $('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });

        body.on('hidden.bs.popover', function (e) {
            $(e.target).data("bs.popover").inState.click = false;
        });
    });
</script>
@yield('script')
@stack('component-scripts')
</body>
</html>
