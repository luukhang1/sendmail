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
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus-circle"></i> Add Payment</button>
            </div>
            <table class="table table-responsive table-borderless">

                <thead>
                <tr class="bg-light">
                    <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                    <th scope="col" width="5%">Activity</th>
                    <th scope="col" width="40%">Date</th>
                    <th scope="col" width="10%">Type</th>
                    <th scope="col" width="20%">Phone</th>
                    <th scope="col" width="20%">Name</th>
                    <th scope="col" width="20%">Bank Number</th>
                    <th scope="col" width="20%">Bank Name</th>
                    <th scope="col">Action</th>
                    {{--                    <th scope="col" class="text-end" width="20%"><span>Revenue</span></th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>
                        <td>{{$payment->active}}</td>
                        <td width="40%">{{$payment->created_at}}</td>
                        <td>{{$payment->type}}</span></td>
                        <td>{{$payment->phone}}</td>
                        <td>{{$payment->bank_account}}</td>
                        <td>{{$payment->bank_number}}</td>
                        <td>{{$payment->bank_name}}</td>
                        <td>
                            <i class="fa fa-trash" style="color: red" onclick="deletePayment('{{$payment->id}}')"></i>
                            <i class="fa fa-pencil" style="color: #ff6200" onclick="addId('{{$payment}}')" data-toggle="modal" data-target="#modeledit"></i>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>
    <!-- /.content -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('site.add-payment')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <select class="form-control" name="type" id="type_payment">
                                <option value="1">MoMo</option>
                                <option value="2">Bank(Ngân hàng) </option>
                            </select>
                        </div>
                        <div class="form-group momo">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group momo">
                            <label for="bank_mono_name">MoMo Name</label>
                            <input type="text" class="form-control" id="bank_mono_name" name="bank_mono_name" placeholder="Họ và Tên">
                        </div>
                        <div class="form-group bank">
                            <label for="bank_number">Bank Number </label>
                            <input type="text" class="form-control" id="bank_number" name="bank_number" placeholder="Số Tài Khoản">
                        </div>
                        <div class="form-group bank">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Tên Ngân Hàng">
                        </div><div class="form-group bank">
                            <label for="bank_account">Bank Account Name</label>
                            <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Họ và Tên">
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
{{--/ edit--}}
    <div class="modal fade" id="modeledit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('site.edit-payment')}}" method="post" id="form-edit">
                        <input type="hidden" name="_id" id="_id" value="" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <select class="form-control" name="type1" id="type_payment_edit">
                                <option value="1">Mono</option>
                                <option value="2">Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="active" id="active">
                                <option value="1">Active</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>
                        <div class="form-group momo1">
                            <label for="phone1">Phone</label>
                            <input type="text" class="form-control" name="phone1" id="phone1" placeholder="Enter phone">
                        </div>
                        <div class="form-group momo1">
                            <label for="bank_mono_name1">Mono Name</label>
                            <input type="text" class="form-control" id="bank_mono_name1" name="bank_mono_name1" placeholder="Enter momo name">
                        </div>
                        <div class="form-group bank1">
                            <label for="bank_number1">Bank Number</label>
                            <input type="text" class="form-control" name="bank_number1" id="bank_number1" placeholder="Enter bank number">
                        </div>
                        <div class="form-group bank1">
                            <label for="bank_name1">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name1" name="bank_name1" placeholder="Enter bank name">
                        </div><div class="form-group bank1">
                            <label for="bank_account1">Bank Account Name</label>
                            <input type="text" class="form-control" id="bank_account1" name="bank_account1" placeholder="Enter account name">
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

