<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('templates/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/select2/dist/css/select2.min.css')}}">

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
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/login"><b>SubMoney</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="border-radius: 5px">
        <p class="login-box-msg">Đăng nhập hệ thống</p>

        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" name="email" value="{{ old('email') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8" style="padding-left: 36px">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Nhớ mật khẩu
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 4px">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
{{--        @php--}}
{{--            $setting = \App\Core\Setting\Setting::get(\App\Enum\Setting::AUTHORIZE_TICKET_VIA_KV_TICKET);--}}
{{--        @endphp--}}
{{--        @if (!empty($setting) && $setting == 1)--}}
{{--            <a href="{{ url('redirect') }}" class="btn btn-block btn-social btn-facebook"><i class="fa fa-ticket"></i> Đăng nhập bằng KVTicket</a>--}}
{{--        @endif--}}
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('templates/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('templates/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

</body>
</html>
