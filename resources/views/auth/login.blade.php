@extends('backend.layouts.login_layout')
  
@section('content')

<div class="content">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('/') }}backend/images/logo.png" alt="" />
        </a>
    </div>
    <form class="form-horizontal login-form" role="form" novalidate="novalidate" method="POST" action="{{ route('validate.login') }}">
        {{ csrf_field() }}
        <h3 class="form-title font-green">Sign In</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter Email and password. </span>
        </div>
        @if ($errors->has('email'))
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span>{{ $errors->first('email') }}</span>
        </div>
        @endif

        @if ($errors->has('password'))
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span>{{ $errors->first('password') }}</span>
        </div>
        @endif                
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email Address" name="email" value="{{old('email')}}" />                   
        </div>


        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="password" name="password" />  
        </div>

        <input type="hidden" name="user_role_id" value="1">

        <div class="form-actions">
            <button type="submit" class="btn green uppercase">Login</button>
            {{-- <label class="rememberme check">
                <input type="checkbox" name="remember" />Remember </label> --}}
            <a class="forget-password" href="{{ route('admin.password.request') }}">Forgot Password?</a>
        </div>                                
    </form>
    
</div>
@endsection