@extends('users.layouts.app')
@section('content')
    <style>
        .loader {
            width: 40px;
            height: 40px;
            border: 5px solid #FFF;
            border-bottom-color: #FF3D00;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <body>
    <div class="nav bg-aqua-active" style="background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
        <div style=" height:100px;display: flex; justify-content: center; gap: 2rem; align-items: center; width: 100%">
            <ul style="display: flex; flex-wrap: wrap; list-style-type: none; gap: 2rem;">
                <li style="font-size: 18px; color: #ff865d">SUBMONEY</a></li>
                <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.index')}}">HOME</a></li>
                <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.login')}}">LOGIN</a></li>
                <li style="font-size: 18px; color: #ff865d"><a style="font-size: 18px; color: #ff865d" href="{{route('home.register')}}">SIGN UP</a></li>
                <li style="font-size: 18px; color: #ff865d"> PAGES</li>
            </ul>
        </div>
    </div>
    <div class="bg-aqua-active" style="width: 100%; height: 80vh; padding-top: 10%; background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
       <div style="display: flex; width: 100%; justify-content: center">
           <div style="border-radius: 5px;background: #dde1e7; width: 300px; height: 300px;">
               <div style="align-items:center; padding-top: 20%; background: #dde1e7; height: 100%; display: flex; flex-direction: column; gap: 2rem; border-radius: 5px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; ">
                   <a onclick="getLink()" id="get-link" style="text-decoration: none;
                   width: 90%;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background: #f2f3f7; display: flex; justify-content: space-between; align-items: center"
                       class="step linky buttonpanel buttonpanel-block btn-lg locked-action-link" target="_blank">
                   <span class="subtlepanel">
                       <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                          <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                   </span>
                       <span style="color: #121212">DOWNLOAD FILE</span>
                       <div id="loading">
                           <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                               <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                               <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                           </svg>
                       </div>
                       <span id="loader" class="loader" style="display: none"></span>
                       <div id="checked" style="display: none">
                           <svg color="green" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                               <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                           </svg>
                       </div>
                   </a>
               </div>
           </div>
       </div>
    </div>
    </body>
    <form action="">

    </form>
    <div class="footer bg-aqua-active" style="height: 9vh; width: 100%; background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
        Copy right me
    </div>
    <!-- /.content -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script>
    let check = false;
    $(document).ready(function () {
            $('#loading').hide()
            $('#loader').show()

            setTimeout(() => {
                $('#loader').hide()
                $('#checked').show()
                check = true
                $('#get-link').attr("href", '{{$link->linkfile}}')
            }, 5000 )
    })
    function getLink() {
        if (check) {
            let urlParams =  new URLSearchParams(location.search)
            let id = urlParams.get('id')
            $.ajax({
                url: '{{route('site.submit')}}',
                type: 'post',
                data: { _token: '{{csrf_token()}}',id: id},
                success: function (data) {
                },
            })
            check = false
        }
    }
</script>

