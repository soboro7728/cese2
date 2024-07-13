@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
新規代表者登録画面だよ
<div class="attendance__content">
    <div class="attendance__panel">
        <form action="admin/create" method="post">
            @csrf
            <label>
                店舗名：
                <select name="shop_id" required="required">
                    <option value="">--選択--</option>
                    @foreach ($shops as $shop)
                    <option value="{{ $shop['id'] }}">{{ $shop['name'] }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <label>
                代表者名：
                <input type="text" name="name" placeholder="例: 山田太郎" value="{{ old('name') }}" required="required" />
            </label>
            <br>
            <label>
                メールアドレス：
                <input type="email" name="email" placeholder="例: test@test.com" value="{{ old('email') }}" required="required" />
            </label>
            <br>
            <label>
                パスワード：
                <input type="password" name="password" required="required" />
            </label>

            <br>
            <button>登録</button>
        </form>
    </div>
</div>


@endsection