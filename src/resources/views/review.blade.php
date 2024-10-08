@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<h1 class="shop_review">レビュー一覧</h1>
@foreach ($reviews as $review)
<div class="review">
    <div class="review__img">
        <img class="review__img2" src="{{ asset('/storage/image/' . $review->image_path) }}" alt="{{$review->image_path}}" />
    </div>
    <div class="review_stars">
        星{{$review->stars}}
    </div>
    <div class="review_comment">
        {{$review->comment}}
    </div>
</div>
<br>
@endforeach
@endsection