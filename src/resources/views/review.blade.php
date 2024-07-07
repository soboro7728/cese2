@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
レビュー一覧画面だよ
@foreach ($reviews as $review)
<div class="review">
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