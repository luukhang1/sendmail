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
                <li style="font-size: 18px; color: #ff865d">SUBMONEY</li>
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
                   <a onclick="getLink(this)" id="subscribe" style="text-decoration: none;
                   width: 90%;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background: #f2f3f7; display: flex; justify-content: space-between; align-items: center"
                      href="{{$link->_link}}"
                       class="step linky buttonpanel buttonpanel-block btn-lg locked-action-link" target="_blank">
                   <span class="subtlepanel">
                       <svg color="red" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                          <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                        </svg>
                   </span>
                       <span style="color: #121212">SUB &amp; HIT BELL </span>
                       <div id="loading">
                           <svg color="#B0B0B0" style="font-weight: bold; font-size: x-large" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                               <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                           </svg>
                       </div>
                       <span id="loader" class="loader" style="display: none"></span>
                       <div id="checked" style="display: none">
                           <svg color="green" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                               <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                           </svg>
                       </div>
                   </a>
                   <a id="get-link" style="text-decoration: none;
                   width: 90%; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;background: #e4e9f1; display: flex; justify-content: space-between; align-items: center" class="step linky buttonpanel buttonpanel-block btn-lg locked-action-link" target="_blank">
                   <span class="subtlepanel">
                      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                          <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                   </span>
                       <span style="color: #121212">SUB &amp; HIT BELL </span>
                       <div>
                           <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                               <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                               <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                           </svg>
                       </div>

                   </a>
               </div>
           </div>
       </div>
    </div>
    </body>
    <div class="footer bg-aqua-active" style="height: 9vh; width: 100%; background: linear-gradient( -45deg ,#1045db 0%,#15095e 60%,#15095e 99%);">
        Copy right me
    </div>
    <!-- /.content -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script>
    function parseURLParams(url) {
        var queryStart = url.indexOf("?") + 1,
            queryEnd   = url.indexOf("#") + 1 || url.length + 1,
            query = url.slice(queryStart, queryEnd - 1),
            pairs = query.replace(/\+/g, " ").split("&"),
            parms = {}, i, n, v, nv;

        if (query === url || query === "") return;

        for (i = 0; i < pairs.length; i++) {
            nv = pairs[i].split("=", 2);
            n = decodeURIComponent(nv[0]);
            v = decodeURIComponent(nv[1]);

            if (!parms.hasOwnProperty(n)) parms[n] = [];
            parms[n].push(nv.length === 2 ? v : null);
        }
        return parms;
    }

    function getLink(e) {
        let url = window.location.href
        let urlParams =  new URLSearchParams(location.search)
        let id = urlParams.get('id')
        $('#loading').hide()
        $('#loader').show()
        setTimeout(() => {
            $('#loader').hide()
            $('#checked').show()
            $('#get-link').css('background','#f2f3f7')
            let url = '{{route('site.get-file')}}' + '?check-url=true&id='+id
            $('#get-link').attr("href", url)
        }, 5000);
    }
</script>

