@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__form__error">
    @error('email')
    {{ $message }}
    @enderror
</div>
<div class="login__form__error">
    @error('password')
    {{ $message }}
    @enderror
</div>
<div class="login__content">
    <div class="login__form__heading">
        <h2>Login</h2>
    </div>
    <form class="login__form" action="/login" method="post">
        @csrf
        <div class="login__form">
            <div class="login__form__email">
                <input class="login__form__input" type="email" name="email" placeholder="Email" value=" {{ old('email') }}" />
            </div>
            <div class="login__form__password">
                <input class="login__form__input" type="password" name="password" placeholder="Password" />
            </div>
            <div class="login__form__button">
                <button class="login__form__button-submit" type="submit">ログイン</button>
            </div>
        </div>
    </form>

</div>

@endsection