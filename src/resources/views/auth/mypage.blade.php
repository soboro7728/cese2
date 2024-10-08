@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage__content">
    <h1 class="mypage__name">{{ $auths->name }}さん</h1>
    <div class=" mypage__content__pannel">
        <div class="reservation">
            <h2>予約状況</h2>
            @foreach ($reservations as $key=>$reservation)
            <div class="reservation_card">
                <p>予約{{$key+1}}</p>
                <div class="reservation_card__content">
                    <div class="reservation_card__content-label">
                        <p class="reservation_card__content-label-item">Shop</p>
                        <p class="reservation_card__content-label-item">Date</p>
                        <p class="reservation_card__content-label-item">Time</p>
                        <p class="reservation_card__content-label-item">Number</p>
                    </div>
                    <div class="reservation_card__content-tag">
                        <p class="reservation_card__content-tag-item">{{ $shops[$reservation->shop_id-1]->name }}</p>
                        <p class="reservation_card__content-tag-item">{{ $reservation->date }}</p>
                        <p class="reservation_card__content-tag-item">{{ $reservation->time }}</p>
                        <p class="reservation_card__content-tag-item">{{ $reservation->number }}人</p>
                    </div>
                </div>
                @if($now < $reservation->date)
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
                    @else
                    <form class="form" action="/reservation/review" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                        <button class="date-nav__button">レビューする</button>
                    </form>
                    <form class="form" action="/reservation/review" method="post">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                        <button class="date-nav__button">テストレビューする</button>
                    </form>
                    @endif
            </div>
            @endforeach
        </div>
        <div class="favorite">
            <h2>お気に入り店舗</h2>
            <div class="favorite__card">
                @foreach ($favorites as $favorite)
                <div class="card">
                    <div class="card__img">
                        <img src="{{ asset('/storage/image/' . $favorite->shop->image_path) }}" alt="{{ $favorite->shop->image_path}}" />
                    </div>
                    <div class="card__content">
                        @php
                        $favorite_shop = $shops[$favorite->shop_id-1]
                        @endphp
                        <h2 class="card__content-ttl">
                            {{ $favorite->shop->name }}
                        </h2>
                        <div class="card__content-tag">
                            <p class="card__content-tag-item">#{{ $favorite->shop->region }}</p>
                            <p class="card__content-tag-item">#{{ $favorite->shop->genre }}</p>
                        </div>
                        <div class="card__content__form">
                            <form class="card__content__form-item" action="/detail" method="get">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                                <button class="date-nav__button">詳しくみる</button>
                            </form>
                            <form class="card__content__form-item" action="/favorites/delete/mypage" method="post">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                                <button class="card__button">解除</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection