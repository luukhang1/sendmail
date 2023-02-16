<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle') {{!empty($pageHeader) ? $pageHeader : 'SUBMONEY'}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('templates/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/toastr/toastr.min.css')}}">

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

    @yield('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('adminlte.layouts.header')
    @include('adminlte.layouts.sidebar')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="flash-message cashbook-screen">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                                <p class="alert alert-{{ $msg }}">{!!  Session::get('alert-' . $msg) !!} <a href="#"
                                                                                                            class="close"
                                                                                                            data-dismiss="alert"
                                                                                                            aria-label="close">&times;</a>
                                </p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                </div>
                @yield('content')
            </div>
        </section>
    </div>

    @include('adminlte.layouts.footer')
</div>

<script src="{{asset('templates/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('templates/adminlte/dist/js/adminlte.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-notify-master/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-notify-master/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('js/jquery.toaster.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/toastr/toastr.min.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('templates/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
<script>
  //fake toastr message
  toastr.options = {
    timeOut: 5000, positionClass: "toast-bottom-right"
  }
</script>
@yield('script')
@stack('component-scripts')
</body>
</html>
