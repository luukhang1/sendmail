<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle') {{!empty($pageHeader) ? $pageHeader : 'Kiotviet Giao Van'}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdn-pos1.kiotviet.vn/2021/7/8/17_8/assets/css/mains.702f6dcc.css">
    @yield('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('adminlte.layouts.header')
{{--    @include('adminlte.layouts.sidebar')--}}
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
{{--    @if(auth()->user()->hasDirectPermission('crm.ticket.index'))--}}
{{--        @include('adminlte.crm.ticket.share.popup')--}}
{{--    @endif--}}
</div>

<script src="{{asset('templates/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('js/jquery.toaster.js')}}"></script>
{{--<script src="https://cdn-pos1.kiotviet.vn/2021/7/8/17_8/app/main.3465f824.js"></script>--}}
@yield('script')
@stack('component-scripts')
</body>
</html>
