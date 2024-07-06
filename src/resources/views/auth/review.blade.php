@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
レヴュー画面だよ

<form class="review" action="/review/create" method="post">
    @csrf
    <h3>{{ $shop->name }}のレビュー投稿</h3>
    <h4>スター</h4>
    <div>
        <input type="radio" name="stars" value="5" />
        <label for="starChoice">星5</label><br>
        <input type="radio" name="stars" value="4" />
        <label for="starChoice">星4</label><br>
        <input type="radio" name="stars" value="3" checked />
        <label for="starChoice">星3</label><br>
        <input type="radio" name="stars" value="2" />
        <label for="starChoice">星2</label><br>
        <input type="radio" name="stars" value="1" />
        <label for="starChoice">星1</label><br>
    </div>
    <h4>コメント</h4>
    <input type="text" name="comment" value="{{ old('detail') }}" />
    <br>
    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
    <div class="review__button">
        <button class="review__button-submit" type="submit">投稿する</button>
    </div>
</form>

@endsection