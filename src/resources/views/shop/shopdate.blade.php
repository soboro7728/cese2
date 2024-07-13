@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
店舗データだよ
<br>
現在のデータ
<div class="shop">
    <div class="shop__img">
        <img src="{{ asset('/storage/image/' . $shop->image_path) }}" alt="{{$shop->image_path}}" />
    </div>
    <div class="shop__content">
        <h2 class="shop__content-ttl">
            {{ $shop->name }}
        </h2>
        <div class="shop__content-tag">
            <p class="shop__content-tag-item">#{{ $regions[$shop->region_id-1]->region }}</p>
            <p class="shop__content-tag-item">#{{ $genres[$shop->genre_id-1]->genre }}</p>
        </div>
        <div class="shop__content-detail">
            <p>{{ $shop->detail }}</p>
        </div>
    </div>
</div>
<div class="attendance__content">
    <div class="attendance__panel">
        <form action="shop/create" method="post" enctype='multipart/form-data'>
            <label>
                店舗名：
                <input type="text" name="name" value="{{ $shop->name }}" required="required" />
            </label>
            <br>
            <label>
                地域：
                <select name="region_id" required="required">
                    <option " " selected>選択して下さい</option>
                    @foreach ($regions as $region)
                    <option value="{{ $region['id'] }}">{{ $region['region'] }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <label>
                ジャンル：
                <select name="genre_id" required="required">
                    <option " " selected>選択して下さい</option>
                    @foreach ($genres as $genre)
                    <option value="{{ $genre['id'] }}">{{ $genre['genre'] }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <label>
                紹介コメント：
                <input type="text" name="detail" value="{{ $shop->detail }}" />
            </label>
            <br>
            <input type="file" name="thumbnail" />
            <br>
            <button>更新</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection