@extends('auth.index_auth')
@section('title', 'Login -')
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection
@section('content')
<div class="row ptb50">
    <div class="container">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <div class="card p10">
                <h2 class="center">Login Dashboard</h2>
                <p class="center">Belum punya akun?
                    <a href="/register">Daftar disini</a>
                </p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row center">
                        <div class="input-field inline col m8 offset-m2">
                            <label for="email_inline">{{ __('E-Mail Address') }}</label>
                            <input id="email_inline" type="email" class="validate{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-field inline col m8 offset-m2">
                            <label for="password_inline">{{_('Password')}}</label>
                            <input id="password_inline" type="password" class="validate{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-field">
                            <button type="submit" name="submit" class="btn waves-effect waves-light  col m8 offset-m2">{{ __('Login') }}</button>
                        </div>
                    </div>
                </form>
                <p class="center">Lupa Password? reset
                    <a href="#">disini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
