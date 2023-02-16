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
                    <th scope="col" width="5%">Activity</th>
                    <th scope="col" width="40%">User Id</th>
                    <th scope="col" width="10%">Config Price</th>
                    <th scope="col" width="20%">Config Domain</th>
                    <th scope="col">Action</th>
                    {{--                    <th scope="col" class="text-end" width="20%"><span>Revenue</span></th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($configs as $config)
                    <tr>
                        <th scope="row"><input class="form-check-input" type="checkbox"></th>
                        <td>{{$config->status}}</td>
                        <td width="40%">{{$config->user_id}}</td>
                        <td>{{$config->price}}</span></td>
                        <td>{{$config->domain}}</td>
                        <td>
                            <i class="fa fa-pencil" style="color: #ff6200" onclick="addId('{{$config}}')" data-toggle="modal" data-target="#modeledit"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$configs->links()}}

    </section>
    <!-- /.content -->
    <!-- Button trigger modal -->
    {{--/ edit--}}
    <div class="modal fade" id="modeledit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Config</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('site.edit-config')}}" method="post" id="form-edit-config">
                        <input type="hidden" name="_id" id="_id" value="" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label>Activity</label>
                            <select class="form-control" name="status" id="activity">
                                <option value="1">Active</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>

                        <div class="form-group ">
                            <label for="user_id">User Id</label>
                            <input readonly type="text" class="form-control" id="user_id" name="user_id1" >
                        </div>
                        <div class="form-group ">
                            <label for="config_price">Config Price</label>
                            <input type="text" class="form-control" name="config_price" id="config_price" placeholder="Enter config price">
                        </div>
                        <div class="form-group">
                            <label for="config_domain">Config Domain</label>
                            <input type="text" class="form-control" id="config_domain" name="config_domain" placeholder="Enter config domain">
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
    function addId(data) {
        const data1 = JSON.parse(data)
        $('#_id').val(data1.id)
        const type = data1.status == 'Active' ? 1 : 0
         $('#activity').val(type)
        $('#user_id').val(data1.user_id)
        $('#config_price').val(type)
        $('#config_price').val(data1.price)
        $('#config_domain').val(data1.domain)
    }
</script>

