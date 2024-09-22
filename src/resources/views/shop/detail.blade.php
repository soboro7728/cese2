@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
    <div class="detail__content__inner">
        <div class="shop">
            <div class="shop__ttl">
                <form class="shop__content-ttl" action="/">
                    @csrf
                    <button class="shop__content-ttl-button">
                        < </button>
                </form>
                <h2 class="shop__content-ttl">
                    {{ $shop->name }}
                </h2>
            </div>
            <div class="shop__img">
                <img src="{{ asset('/storage/image/' . $shop->image_path) }}" alt="{{$shop->image_path}}" />
            </div>
            <div class="shop__content">
                <div class="shop__content-tag">
                    <p class="shop__content-tag-item">#{{ $shop->region }}</p>
                    <p class="shop__content-tag-item">#{{ $shop->genre }}</p>
                </div>
                <div class="shop__content-detail">
                    <p>{{ $shop->detail }}</p>
                </div>

            </div>
            @if($review==null)
            <div>
                <form class="shop__review__post" action="/review/post">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <button class="shop__review__post__btn">
                        口コミを投稿する
                    </button>
                </form>
            </div>
            @else
            <div class="card__content__review">
                <form class="card__content__form__review" action="/review" method="get">
                    @csrf
                    <input type="hidden" name="id" value="{{ $shop->id }}">
                    <button class="card__button">全ての口コミ情報</button>
                </form>
            </div>
            <div class="review__view">
                <div class="review__view__link">
                    <form class="shop__review__post" action="/review/edit">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button class="shop__review__post__btn-edit">
                            口コミを編集する
                        </button>
                    </form>
                    <form class="shop__review__post" method="post" action="/review/delete">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button class="shop__review__post__btn-edit">
                            口コミを削除する
                        </button>
                    </form>
                </div>
                <div class="detail__review">
                    <span class="star5_rating" data-rate="{{ $review->stars }}"></span>
                    <p class="comment">{{ $review->comment }}</p>
                </div>
            </div>
            @endif
        </div>
        @if(isset($auths))
        <div class="reservation">
            <div class="reservation__panel">
                <h2 class="reservation__ttl">予約</h2>
                <form action="/shop/confirm" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $shop->id }}">
                    <input class="reservation__form-day" type="date" id="input_date" name="date" value="" onchange="inputCheck()" />
                    <br>
                    <select class="reservation__form" name="time" id="input_time" value="" onchange=" inputChecktime()" />
                    <option value="選択して下さい" selected>選択して下さい</option>
                    @foreach ($shoptimes as $shoptime)
                    <option value="{{ substr($shoptime['shoptime'], 0, 5) }}">{{ substr($shoptime['shoptime'], 0, 5) }}</option>
                    @endforeach
                    </select>
                    <br>
                    <input class="reservation__form" type="number" name="number" id="input_number" min="1" value="" onchange="inputChecknumber()" />
                    <br>
                    <div class="reservation__panel__confirm">
                        <p class="reservation__panel__text">Shop ：　{{ $shop->name }}</p>
                        <p class="reservation__panel__text" id="date_check"></p>
                        <p class="reservation__panel__text" id="time_check"></p>
                        <p class="reservation__panel__text" id="number_check"></p>
                    </div>
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <button class="reservation__panel__button">予約する</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function inputCheck() {
            var inputValue = document.getElementById("input_date").value;
            document.getElementById("date_check").innerHTML = 'Date  ：　' + inputValue;
        }

        function inputChecktime() {
            var inputValue = document.getElementById("input_time").value;
            document.getElementById("time_check").innerHTML = 'Time  ：　' + inputValue;
        }

        function inputChecknumber() {
            var inputValue = document.getElementById("input_number").value;
            document.getElementById("number_check").innerHTML = 'Number  ：　' + inputValue;
        }
    </script>
    @endif
</div>

@endsection