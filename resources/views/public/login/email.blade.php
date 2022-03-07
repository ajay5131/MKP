@extends('public.layouts.layout')

@section('content')

    <section class="login-section">
        <div class="container text-center">
            <div class="login-container">
                <h1 class="login-title">Forgot Password?</h1>
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="input-container">
                        <input type="text" name="email" class="form-control login-input" placeholder="Email Address" value="{{ old('email') }}">
                        <i class="fa fa-user-o login-icon" aria-hidden="true"></i>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif

                    <div class="input-container">
                        <button type="submit" class="LoginBtn btn">{{__('Send Password Reset Link')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection
