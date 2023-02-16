@extends('adminlte.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Admin
            <small>Managerment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div style="overflow: auto">
            <table class="table table-responsive table-borderless">

                <thead>
                <tr class="bg-light">
                    <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="20%">Date</th>
                    <th scope="col" width="25%">Link File</th>
                    <th scope="col" width="20%">Link SubMoney</th>
{{--                    <th scope="col" class="text-end" width="20%"><span>Revenue</span></th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                    <tr>
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>
                        <td>{{$link->id}}</td>
                        <td width="20%">{{$link->created_at}}</td>
                        <td style="word-break: break-all" width="25%">{{$link->linkfile}}</td>
                        <td>{{route('home.nextpage', $link->slug)}} <i class="fa fa-copy" style="color: #0b93d5" onclick="copy('{{route('home.nextpage', $link->slug)}}')"></i></td>
{{--                        <td class="text-end"><span class="fw-bolder">$0.99</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>
    <!-- /.content -->
@endsection
<style>
    @media only screen and (max-width: 600px) {
        .view-total {
            width: 100% !important;
        }
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>

<script>

    function copy(data) {
        let text = data
        {{--text = '{{route('home.nextpage', data)}}'+'?id='+data--}}
        toastr.success('copy done')
        if (window.clipboardData && window.clipboardData.setData) {
            // IE: prevent textarea being shown while dialog is visible
            return window.clipboardData.setData("Text", text);

        } else if (document.queryCommandSupported &&
            document.queryCommandSupported("copy")) {
            var textarea = document.createElement("textarea");
            textarea.textContent = text;
            // Prevent scrolling to bottom of page in MS Edge
            textarea.style.position = "fixed";
            document.body.appendChild(textarea);
            textarea.select();
            try {
                // Security exception may be thrown by some browsers
                return document.execCommand("copy");
            } catch (ex) {
                console.warn("Copy to clipboard failed.", ex);
                return false;
            } finally {
                document.body.removeChild(textarea);
            }
        }
    }
</script>

