@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
レビュー画面だよ
@foreach ($reviews as $review)
<div class="review">
    <p>店舗名：{{ $review->shop->name }}</p>
    <p>ユーザー名：{{ $review->user->name }}</p>
    <p>評価：星{{ $review->stars }}</p>
    <p>コメント：{{ $review->comment }}</p>
    @if($review->image_path != null)
    <img class="review__img2" src="{{ asset('/storage/image/' . $review->image_path) }}" alt="{{$review->image_path}}" />
    @endif
    <form class="" action="review/delete" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ $review->user->id }}">
        <input type="hidden" name="shop_id" value="{{ $review->shop->id }}">
        <button class="card__button">削除</button>
    </form>
</div>
@endforeach


@endsection