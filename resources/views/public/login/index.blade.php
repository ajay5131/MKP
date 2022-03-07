@extends('public.layouts.layout')

@section('content')

    <section class="login-section">
        <div class="container text-center">
            <div class="login-container">
                <h1 class="login-title">Welcome Back !</h1>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    
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
                    <div class="input-container">
                        <input type="text" name="email" class="form-control login-input" placeholder="Email Address" value="{{ old('email') }}">
                        <i class="fa fa-user-o login-icon" aria-hidden="true"></i>
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" class="form-control login-input" placeholder="Password">
                        <i class="fa fa-key login-icon"></i>
                    </div>
                    <div class="input-container forgot-pass-txt">
                        <a href="{{ route('password.request') }}" class="forgot-pass-link">Forgot Password</a>
                    </div>
                    <div class="input-container">
                        <button type="submit" class="LoginBtn btn">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection
