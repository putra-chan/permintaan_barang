@extends('auth.index_auth')
@section('title', 'Register')
@section('css')

@endsection
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@section('content')
<div class="row pt25">
    <div class="container">
        <div class="col s12 m6 offset-m3">
            <div class="card p10">
                <h2 class="center">Register</h2>
                <p class="center">Sudah punya akun?
                    <a href="/login">Login</a>
                </p>
                <form class="" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="input-field inline col m8 offset-m2">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" name="name" class="validator{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-field inline col m8 offset-m2">
                            <label for="email">{{ __('Your Email') }}</label>
                            <input id="email" type="email" name="email" class="validator{{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('email'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-field inline col m8 offset-m2">
                            <label for="phone">{{ __('No HP') }}</label>
                            <input id="phone" type="text" name="phone" class="validator{{ $errors->has('phone') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('phone'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-field inline col m8 offset-m2">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" class="validator{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('password'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-field inline col m8 offset-m2">
                            <label for="password-confirm">{{ __('Password Confirm') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="input-field">
                            <button type="submit" name="submit" class="btn waves-effect waves-light  col m8 offset-m2">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
