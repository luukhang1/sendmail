@extends('adminlte.layouts.app')

@section('content')
    <div class="container form-mail">
        <div class="row justify-content-center col-md-6">
            <div class="">
    <div class="card shadow mx-auto">
        <div class="card-body">
            <form method="GET" action="{{route('mail.send')}}">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="Anh Bé Của Em">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" placeholder="Enter message"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
<style>
    @media only screen and (max-width: 600px) {
        .view-total {
            width: 100% !important;
        }
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        max-width: 500px;
        margin: 0 auto;
    }

    .card-body {
        padding: 2rem;
    }

    h2 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    .form-group label {
        font-size: 2rem;
        font-weight: bold;
    }

    .form-control {
        border-color: #ced4da;
        border-radius: 10px;
        padding: 0.5rem 0.75rem;
        font-size: 2rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 10px;
        font-size: 2rem;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

</style>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    $(document).ready(function () {
        $('.form-mail').css('padding-top',`${$('.navbar-custom-menu').height()}px`)
        console.log($('.navbar-custom-menu').height())
    })
</script>
