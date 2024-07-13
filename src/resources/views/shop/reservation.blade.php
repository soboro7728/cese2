@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
店舗予約一覧だよ

@foreach ($reservations as $reservation)
<div class="reservation_card">
    <div class="reservation_card__content">
        <div class="reservation_card__content-tag">

            <p class="reservation_card__content-tag-item">名前：{{ $reservation->user->name }}</p>
            <p class="reservation_card__content-tag-item">日付：{{ $reservation->date }}</p>
            <p class="reservation_card__content-tag-item">時間：{{ $reservation->time }}</p>
            <p class="reservation_card__content-tag-item">人数：{{ $reservation->number }}</p>
        </div>
    </div>
</div>
@endforeach

@endsection