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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>
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
            <li style="font-size: 18px; color: #ff865d">SUBMONEY</li>
            <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.index')}}">HOME</a></li>
            <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.login')}}">LOGIN</a></li>
            <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.register')}}">SIGN UP</a></li>
            <li style="font-size: 18px; color: #ff865d"> PAGES</li>
        </ul>
    </div>
</div>
<div class="bg-aqua-active" style="width: 100%; height: 80%; padding-top: 10%; background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
    <div  style="display: flex; justify-content: center">

        <div id="form-create-link" class="col-lg-6 col-md-6 col-xs-6">
            <div style="width: 100%">
                <span onclick="addNewLink()" id="_addlink"
                    style="width: 300px;  height: 100px;
                    background-color: #f17e4d; border-radius: 3px;cursor: pointer">
                + Add Link like/Cmt/Subscribe
                </span>
            </div>
            <form id="createlink">
                <div class="form-group" id="__link" style="display: none">
                    <label for="_link">Link like/Cmt/Subscribe</label>
                    <input style="border-radius: 20px; height: 50px"
                           name="_link"
                           type="text" class="form-control" id="_link" placeholder="Link thứ hai (Channel or Video) ">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Link youtube</label>
                    <input style="border-radius: 20px; height: 50px"
                           required
                           name="linkyoutube"
                           type="text" class="form-control" id="link1" aria-describedby="emailHelp" placeholder="Link thứ nhất (Channel or Video) ">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Link file</label>
                    <input style="border-radius: 20px; height: 50px"
                           required name="linkfile"
                        type="text" class="form-control" id="link2" placeholder="Link file cần khóa">
                </div>
                <div style="width: 100%; display: flex; justify-content: center; padding-top: 20px">
                    <button style="background-image: linear-gradient(to right, purple, pink);font-size:18px;border-radius: 25px; height: 50px; width: 200px"
                            class="btn btn-primary"
                    >Generate Link <i class="fa fa-check-square"></i></button>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
<div class="footer bg-aqua-active" style="height: 20%; width: 100%; background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
    Copy right me
</div>
</html>
<style>
    @media only screen and (max-width: 600px) {
       #form-create-link {
           width: 100%;
       }
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $('#createlink').submit(function (e) {
        e.preventDefault()
        let data = $('#createlink').serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        data.user_id = {{auth()->user()->id}}
        data._token = '{{csrf_token()}}'
        $.ajax({
            data: data,
            type: 'POST',
            url: '/site/create-link',
            success: function (data) {
                toastr.success('thanh cong')
                setTimeout( () => {
                    window.location.href = '{{route('site.all-link')}}'
                }, 1000)
            },
            error: function (e) {
                toastr.error('that bai')
            }
        })
    })
    let click = 1;
    function addNewLink(e) {
        click++;
        if (click % 2 == 0 ) {
            $('#_addlink').css('background', 'white')
            $('#__link').show()
        } else {
            $('#_addlink').css('background', '#f17e4d')
            $('_link').val('')
            $('#__link').hide()
        }

    }
</script>

