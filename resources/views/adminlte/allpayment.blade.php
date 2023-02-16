@extends('adminlte.layouts.app')

@section('content')
    <head>


    </head>
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
            <div style="padding: 20px">
                
            </div>
            <table class="table table-responsive table-borderless">

                <thead>
                <tr class="bg-light">
                    <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                    <th scope="col" width="5%">Activity</th>
                    <th scope="col" width="40%">Date</th>
                    <th scope="col" width="10%">User Name</th>
                    <th scope="col" width="20%">ToTal Money</th>
                    <th scope="col">Action</th>
                    {{--                    <th scope="col" class="text-end" width="20%"><span>Revenue</span></th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>
                        @if($payment->status == 0)
                            <td>Pending</td>
                        @endif
                        @if($payment->status == 2)
                            <td>Success</td>
                        @endif
                        <td width="40%">{{$payment->created_at}}</td>
                        <td>{{$payment->user->name}}</span></td>
                        <td>{{$payment->total_money}}</td>
                        <td>
                            <i class="fa fa-pencil" style="color: #ff6200" onclick="addId('{{$payment}}')" data-toggle="modal" data-target="#modeledit"></i>
                            <i class="fa fa-eye" style="color: #ff6200" onclick="getPayment('{{route('admin.get-payment-user',$payment->user_id)}}')" data-toggle="modal" data-target="#_payment"></i>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>
    <!-- /.content -->

{{--/ edit--}}
    <div class="modal fade" id="modeledit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Payment User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.edit-payment')}}" method="post" id="form-edit">
                        <input type="hidden" name="_id" id="_id" value="" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="money_id" id="money_id" />
                        <div class="form-group">
                            <label for="activity">Activity</label>
                            <select class="form-control" name="status" id="activity">
                                <option value="1">Từ chối</option>
                                <option value="0">Chưa giải quyết</option>
                                <option value="2">Phê duyệt</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">ID</label>
                            <input type="text" readonly class="form-control" name="user_id_1" id="user_id" >
                        </div>
                        <div class="form-group">
                            <label for="total">Money</label>
                            <input type="text" readonly class="form-control" id="total" name="total_money" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive table-borderless">

                    <thead>
                    <tr class="bg-light">
                        <th scope="col" width="40%">Type</th>
                        <th scope="col" width="10%">Phone</th>
                        <th scope="col" width="20%">Bank Number (STK)</th>
                        <th scope="col" width="20%">Bank Name</th>
                        <th scope="col" width="20%">Bank Account Name</th>
                    </tr>
                    </thead>
                    <tbody id="_bankInfo">
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
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
    function getPayment(url) {
        $.ajax({
            type: 'GET',
            url: url,
            success: function (dt) {
                $('#_bankInfo').empty()
                for (let i = 0; i<dt.length;i++) {
                    let string = `<tr><td>${dt[i].type}</td><td>${dt[i].phone}</td><td>${dt[i].bank_number}</td><td>${dt[i].bank_name}</td><td>${dt[i].bank_account}</td></tr>`
                    $('#_bankInfo').append(string)
                }
            }
        })
    }
    function addId(data) {
        if(data) {
            const data1 = JSON.parse(data)
            $('#_id').val(data1.id)
            $('#activity').val(data1.status)
            $('#user_id').val(data1.user_id)
            $('#total').val(data1.total_money)
            $('#money_id').val(data1.money_id)
        }

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

