
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
    <body>
        <div class="nav bg-aqua-active" style="background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
            <div style=" height:100px;display: flex; justify-content: center; gap: 2rem; align-items: center">
                <ul style="display: flex; flex-wrap: wrap; list-style-type: none; gap: 2rem;">
                    <li
                        <a style="font-size: 18px; color: #ff865d" href="{{route('admin.home.index')}}"><img style="width: 30%" src="https://i.imgur.com/Cp8C8rG.png" alt="Tile img" class="bubble-1"></a>
                    </li>
                    <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('admin.home.index')}}">DASHBOARD</a></li>
                    <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.index')}}">HOME</a></li>
                    <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.login')}}">LOGIN</a></li>
                    <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.register')}}">SIGN UP</a></li>
                    <li style="font-size: 18px; color: #ff865d"> PAGES</li>
                </ul>
            </div>
        </div>
    <div class="bg-aqua-active" style="width: 100%; height: 80%; padding-top: 10%; background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
        <section style="width: 100%; display: flex; justify-content: center">
            <div style="width: 80%; display: flex; justify-content: center; align-items: center">
                <div style="width: 40%">
                    <h1>SUBMONEY<br><span id="header-text-change" style="display: inline;"></span></h1>
                    <p class="banner-one__text text-white">Người dùng cần đăng ký và theo dõi kênh của bạn để đến được bất kỳ liên kết đã gắn.
                        Ngoài ra bạn có thể kiếm được tiền với rate $2/1000 view</p>
                    <a href="{{route('user.create-link')}}" class="btn btn-primary" style="width: 150px; height: 50px; border-radius: 30px; background-color: #ff8257; font-weight: 700;display:flex; justify-content: center; align-items: center">Get Started</a>
                </div>

                <div>
                    <img style="width: 100%" src="https://i.imgur.com/nsLMfxn.png" alt="Awesome Image" class="bubble-1">
                </div>
            </div>
        </section>
    </div>
    </body>
    <div class="footer bg-aqua-active" style="height: 20%; width: 100%; background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
        Copy right me
    </div>
</html>

