@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__form__error">
    @error('name')
    {{ $message }}
    @enderror
</div>
<div class="register__form__error">
    @error('email')
    {{ $message }}
    @enderror
</div>
<div class="register__form__error">
    @error('password')
    {{ $message }}
    @enderror
</div>
<div class="register__content">
    <div class="register__form__heading">
        <h2>Registration</h2>
    </div>
    <form class="register__form" action="/register" method="post">
        @csrf
        <div class="register__form">
            <div class="register__form__username">
                <input class="register__form__input" type="text" name="name" value="{{ old('name') }}" placeholder="Username" />
            </div>
            <div class="register__form__email">
                <input class="register__form__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
            </div>
            <div class="register__form__password">
                <input class="register__form__input" type="password" name="password" placeholder="Password" />
            </div>
            <div class="register__form__button">
                <button class="register__form__button-submit" type="submit">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection