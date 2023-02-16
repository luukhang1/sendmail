@extends('adminlte.layouts.app')

@section('content')

    <section class="content-header" style="margin-bottom: 30px">
        <h1>


        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <div style="width: 100%; display: flex; justify-content: center; height: 90%">
        <div style="width: 90%; height: 90%;
     border: 1px solid #f8f8f8; border-radius: 5px; background-color: white"
        >
            <div style="padding: 25px">
                <h4 style="font-size: 25px">Rút Tiền</h4>
            </div>
            <div style="padding: 30px">
                <div>
                    <div
                        style="margin-right: -10px"
                    >
                        <i
                            style="color:purple;font-size: 30px; margin-left: 8px"
                            class="fa fa-plus-circle"></i>
                    </div>
                    <div
                        style="height: 50px;
                    border-left: 1px solid #eee6e6; margin-left: 20px;
                    padding-bottom: 110px"
                    >
                        <div
                            style="margin-top: -41px;
                        padding-left: 50px;display: flex; flex-direction: column"
                        >
                            <span style="font-size: 25px">${{$current}}</span>
                            <span style="font-size: 20px; color: #a49f9f">Thu nhập có sẵn để rút.</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div
                        style="margin-right: -10px"
                    >
                        <i
                            style="color:#ff8800;font-size: 30px; margin-left: 8px"
                            class="fa fa-warning"></i>
                    </div>
                    <div
                        style="height: 50px;
                    border-left: 1px solid #eee6e6; margin-left: 20px;
                    padding-bottom: 110px"
                    >
                        <div
                            style="margin-top: -41px;
                        padding-left: 50px;display: flex; flex-direction: column"
                        >
                            <span style="font-size: 25px">${{$pending}}</span>
                            <span style="font-size: 20px; color: #a49f9f">Bạn đã yêu cầu rút và chờ admin phê duyệt.</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div
                        style="margin-right: -10px"
                    >
                        <i
                            style="color:green;font-size: 30px; margin-left: 8px"
                            class="fa fa-check-circle"></i>
                    </div>
                    <div
                        style="height: 50px; width: 300px;
                    margin-left: 20px;
                    padding-bottom: 110px"
                    >
                        <div
                            style="margin-top: -41px;
                        padding-left: 50px;display: flex; flex-direction: column"
                        >
                            <span style="font-size: 25px">${{$done}}</span>
                            <span style="font-size: 20px; color: #a49f9f">Tổng số tiền xử lý thành công.</span>
                        </div>
                    </div>
                </div>
               

            </div>
            <div style="width: 100%; display: flex; justify-content: center">
                <button onclick="withdrawal('{{$money}}', '{{$setting}}')" class="btn btn-primary">withdrawal</button>
            </div>
             <div style="padding: 25px, margin: 10%">
                <h4 style="font-size: 25px">Tỉ giá quy đổi $1 ~ 21k.</h4>
            </div>
        </div>
    </div>

@endsection
<style>
    @media only screen and (max-width: 600px) {
        .view-total {
            width: 100% !important;
        }
    }
    .bank {
        display: none;
    }
    .bank1 {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
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
                    success: function (){
                        window.location.reload()
                    }
                })
            } else {
                toastr.error('your money are not enough')
            }
        }
    }
    function deletePayment(id) {
        $.ajax({
            url: '{{route('site.del-payment')}}',
            data: {id: id, _token: "{{ csrf_token() }}"},
            type: 'post',
            success: function () {
                toastr.success('Delete success')
                setTimeout(() => {
                    window.location.href = '{{route('admin.home.index')}}'
                }, 1000)
            },
            error: function () {
                toastr.error('Delete fail')
                setTimeout(() => {
                    window.location.href = '{{route('admin.home.index')}}'
                }, 1000)
            }
        })
    }
    function addId(data) {
        const data1 = JSON.parse(data)
        $('#_id').val(data1.id)
        const type = data1.type != 'Momo' ? 2 : 1
        type == 2 ? $('#bank_account1').val(data1.bank_account) : $('#bank_mono_name1').val(data1.bank_account)
        $('#phone1').val(data1.phone)
        $('#type_payment_edit').val(type).trigger('change')
        $('#bank_number1').val(data1.bank_number)
        $('#bank_name1').val(data1.bank_name)
        $('#active').val(data1.active == 'Active' ? 1 : 0)
    }
    $(document).ready(function () {


        $('#type_payment').on('change', function () {
           let type = $('#type_payment').val()
            if (type == 1) {
                $('.momo').show()
                $('.bank').hide()
            } else {
                $('.momo').hide()
                $('.bank').show()
            }
        })
        $('#type_payment_edit').on('change', function () {
            let type = $('#type_payment_edit').val()
            if (type == 1) {
                $('.momo1').show()
                $('.bank1').hide()
            } else {
                $('.momo1').hide()
                $('.bank1').show()
            }
        })
    })
</script>

