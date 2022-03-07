@extends('backend.layouts.login_layout')
  
@section('content')

    <div class="content">
        <div class="logo">
            <a href="#">
                <img src="{{ asset('/') }}backend/images/logo.png" alt="" />
            </a>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('admin.password.email') }}">
            {{ csrf_field() }}
            <h3 class="form-title font-green">Forgot Password?</h3>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">{{__('Email Address')}}</label>

                <div class="col-md-12">
                    <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        {{__('Send Password Reset Link')}}
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection