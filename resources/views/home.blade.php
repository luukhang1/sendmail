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

        <!-- Default box -->
        <div class="box">
            <div style="display: flex; width: 100%; gap: 1rem;flex-wrap: wrap">
                <div class="view-total" style="background-color: #F46B68 !important;width:45%;min-width:max-content; height: 100px;
                background-color: #0b3e6f; border-radius: 10px; margin: 10px; display: flex; justify-content: space-between; align-items: center; padding: 10px">
                    <div style="display: flex; flex-direction: column; align-items: center">
                        <span style="color: white"> Total view</span>
                        <span style="color: white">{{!empty($money) ? $money->view : 0}}</span>
                    </div>
                    <span>
                        <svg color="white" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                          <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                        </svg>
                    </span>
                </div>

                <div class="view-total" style="background-color: #369DC9 !important;width:45%; min-width:max-content; height: 100px;
                background-color: #0b3e6f; border-radius: 10px; margin: 10px; display: flex; justify-content: space-between; align-items: center; padding: 10px">
                    <div style="display: flex; flex-direction: column; align-items: center">
                        <span style="color: white"> Total money</span>
                        <span style="color: white">{{!empty($money) ? $money->view * $money->price : 0}}</span>
                    </div>
                    <span>
                       <svg color="white" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                          <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                        </svg>
                    </span>
                </div>

                <div class="view-total" style="background-color: #2bc155 !important;width:45%; min-width:max-content; height: 100px;
                background-color: #0b3e6f; border-radius: 10px; margin: 10px; display: flex; justify-content: space-between; align-items: center; padding: 10px">
                    <div style="display: flex; flex-direction: column; align-items: center">
                        <span style="color: white"> Total CPM</span>
                        <span style="color: white">{{!empty($money) ? $money->price * 1000 : 0}}</span>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                          <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                        </svg>
                    </span>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!--<div style="width: 100%; display: flex; justify-content: center">-->
        <!--    <button onclick="withdrawal('{{$money}}', '{{$setting}}')" class="btn btn-primary">withdrawal</button>-->
        <!--</div>-->
        <!-- /.box -->
        <canvas id="myChart" style="width:90%"></canvas>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    function withdrawal(data, st) {
        let conf = window.confirm('are you suce')

        if (conf == true) {
            if (!data) {
                toastr.error('you dont have money')
                return;
            }
            console.log(data)
            const dt = JSON.parse(data)
            let money = dt.view * dt.price
            let setting = {
                min : 5
            }
            console.log(st)
            if (st) setting = JSON.parse(st)
            if (money > setting.value) {
                toastr.success('ask to withale money success')
                $.ajax({
                    url: '{{route('site.withdrawal')}}',
                    type: 'GET',
                    success: function (){}
                })
            } else {
                toastr.error('your money are not enough')
            }
        }
    }
    window.onload = function() {
        var ctx = document.getElementById("myChart");
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: 2015,
                    data: [10, 8, 6, 5, 12, 8, 16, 17, 6, 7, 6, 10]
                }]
            }
        })
    }
</script>
