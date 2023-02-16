@extends('users.layouts.app')

@section('content')
<div class="container" style="height: 100vh; background-color: #d2d6de; width: 100vw; margin: 0">
    <div class="row justify-content-center"
         style="height: 100%;align-items: center; background-color: #d2d6de; width: 101vw">
        <div class="col-md-6" style="max-width: 500px;">
            <div class="card " style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class=""
                     style="text-align: center; height: 50px;font-size: 16px; font-weight: 500"
                >Sign up your account</div>

                <div >
                    <form method="POST" action="{{ route('register') }}" id="form-register">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="">Name</label>

                            <div >
                                <input placeholder="Inter Name" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" >E-Mail Address</label>

                            <div>
                                <input placeholder="Inter Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

{{--                        <div class="form-group row">--}}
{{--                            <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <select class="form-control" name="role">--}}
{{--                                    <option value="admin">Admin</option>--}}
{{--                                    <option value="supporter">Supporter</option>--}}
{{--                                    <option value="accountant">Accountant</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="password">Password</label>

                            <div >
                                <input placeholder="Inter Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" >Confirm Password</label>

                            <div >
                                <input placeholder="Inter Password Confirm" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-4"></span>
                        </div>

                        <div class="form-group mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary form-control" style="font-size: 16px">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    #form-register > * {
        font-size: 16px !important;
    }
    #form-register  input {
        height: 50px;
        border-radius: 15px;
    }
    #form-register  button {
        height: 50px;
        border-radius: 15px;
    }
    #form-register  label {
       color: #7e7e7e;
    }
    input::placeholder {
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        color: #7e7e7e;
    }
    .card {
        padding: 30px;
        padding-bottom: 50px;
    }
</style>

