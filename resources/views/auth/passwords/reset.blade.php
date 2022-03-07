
@extends('backend.layouts.login_layout')
  
@section('content')

<div class="content">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('/') }}backend/images/logo.png" alt="" />
        </a>
    </div>

    <form class="form-horizontal" method="POST" action="{{ route('admin.password.request') }}">
        {{ csrf_field() }}
        <h3 class="form-title font-green">Reset Password</h3>
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{-- <label for="email" class="col-md-4 control-label">{{__('Email Address')}}</label> --}}
            
            <div class="col-md-12">
                <input id="email" type="hidden" class="form-control" name="email" value="{{ $email }}" required autofocus>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-12 ">{{__('Password')}}</label>

            <div class="col-md-12">
                <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="col-md-12 ">{{__('Confirm Password')}}</label>
            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    {{__('Reset Password')}}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection