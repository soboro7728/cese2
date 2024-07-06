@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
予約状況

@foreach ($reservations as $reservation)
<div class="reservation_card">
    <div class="reservation_card__content">
        <div class="reservation_card__content-tag">
            <p class="reservation_card__content-tag-item">{{ $shops[$reservation->shop_id-1]->name }}</p>
            <p class="reservation_card__content-tag-item">{{ $reservation->date }}</p>
            <p class="reservation_card__content-tag-item">{{ $reservation->time }}</p>
            <p class="reservation_card__content-tag-item">{{ $reservation->number }}</p>
        </div>
    </div>
    <form class="form" action="/reservation/delete" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $reservation->id }}">
        <button class="date-nav__button">予約削除</button>
    </form>
    <form class="form" action="/reservation/change" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $reservation->id }}">
        <button class="date-nav__button">予約変更</button>
    </form>
    <form class="form" action="/reservation/review" method="post">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
        <button class="date-nav__button">レビューする</button>
    </form>
</div>
@endforeach

@foreach ($favorites as $favorite)
<div class="card">
    <div class="card__img">
        <img src="{{ asset('/storage/image/' . $shops[$favorite->shop_id-1]->image_path) }}" alt="{{$shops[$favorite->shop_id-1]->image_path}}" />
    </div>
    <div class="card__content">
        @php
        $favorite_shop = $shops[$favorite->shop_id-1]
        @endphp
        <h2 class="card__content-ttl">
            {{ $favorite_shop->name }}
        </h2>
        <div class="card__content-tag">
            <p class="card__content-tag-item">#{{ $favorite_shop->region_id }}</p>
            <p class="card__content-tag-item">#{{ $favorite_shop->genre }}</p>
        </div>
        <form class="form" action="/detail" method="get">
            @csrf
            <input type="hidden" name="id" value="{{ $shops[$favorite->shop_id-1]->id }}">
            <button class="date-nav__button">{{ $shops[$favorite->shop_id-1]->name }}</button>
        </form>
        <form class="form" action="/favorites" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $shops[$favorite->shop_id-1]->id }}">
            <button class="date-nav__button">ハート</button>
        </form>
    </div>

</div>
@endforeach

@endsection