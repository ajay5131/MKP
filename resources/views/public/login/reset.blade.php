
@extends('public.layouts.layout')

@section('content')

<section class="login-section">
    <div class="container text-center">
        <div class="login-container">
            <h1 class="login-title">Reset Password</h1>
            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                
                <input type="hidden" name="token" value="{{ $token }}">

                <div>

                    <div class="input-container">
                        <input id="email" type="hidden" class="form-control" name="email" value="{{ $email }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div>
                    <div class="input-container">
                        <input type="password" name="password" class="form-control login-input" placeholder="Password" required>
                        <i class="fa fa-key login-icon"></i>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password') }}
                        </span>
                    @endif

                </div>

                <div>
                    <div class="input-container">
                        <input id="password-confirm" type="password" class="form-control login-input" placeholder="Confirm Password" name="password_confirmation" required>
                        <i class="fa fa-key login-icon"></i>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                    @endif

                </div>

                <div class="input-container">
                    <button type="submit" class="LoginBtn btn">{{__('Reset Password')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection