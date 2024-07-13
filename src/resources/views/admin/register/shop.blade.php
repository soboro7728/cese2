@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
新規店舗登録画面だよ
<div class="attendance__content">
    <div class="attendance__panel">
        <form action="shop/create" method="post">
            @csrf
            <label>
                店舗名：
                <input type="text" name="name" placeholder="例: 山田うどん" value="{{ old('name') }}" required="required" />
            </label>
            <br>
            <label>
                地域：
                <select name="region_id" required="required">
                    <option value="">--選択--</option>
                    @foreach ($regions as $region)
                    <option value="{{ $region['id'] }}">{{ $region['region'] }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <label>
                ジャンル：
                <select name="genre_id" required="required">
                    <option value="">--選択--</option>
                    @foreach ($genres as $genre)
                    <option value="{{ $genre['id'] }}">{{ $genre['genre'] }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <button>登録</button>
        </form>
    </div>
</div>


@endsection