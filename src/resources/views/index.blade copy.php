@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index__content">
    <div>
        <form id="submit_form" action="/search/region" method="get">
            <select onchange="submit(this.form)" name="condition_id">
                <option value="" selected>並び替え：評価高/低</option>
                @foreach ($conditions as $condition)
                <option value="{{ $condition['id'] }}">{{ $condition['condition'] }}</option>
                @endforeach
            </select>
        </form>
        @if(isset($region_id))
        <form id="submit_form" action="/search/region" method="get">
            <select onchange="submit(this.form)" name="region_id">
                <option value="" selected>All area</option>
                @foreach ($regions as $region)
                <option value="{{ $region['id'] }}" @if($region['id']==$region_id) selected @endif>{{ $region['region'] }}</option>
                @endforeach
            </select>
            @if(!empty($genre_id))
            <input type="hidden" name="genre_id" value="{{ $genre_id }}" />
            @endif
        </form>
        @else
        <form id="submit_form" action="/search/region" method="get">
            <select onchange="submit(this.form)" name="region_id">
                <option value="" selected>All area</option>
                @foreach ($regions as $region)
                <option value="{{ $region['id'] }}">{{ $region['region'] }}</option>
                @endforeach
            </select>
            @if(!empty($genre_id))
            <input type="hidden" name="genre_id" value="{{ $genre_id }}" />
            @endif
        </form>
        @endif
    </div>
    <!-- 検索 -->
    <div class="index__search">
        @if(isset($genre_id))
        <form id="submit_form" action="/search/region" method="get">
            <select onchange="submit(this.form)" name="genre_id">
                <option value="" selected>All genre</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre['id'] }}" @if($genre['id']==$genre_id) selected @endif>{{ $genre['genre'] }}</option>
                @endforeach
            </select>
            @if(!empty($region_id))
            <input type="hidden" name="region_id" value="{{ $region_id }}" />
            @endif
        </form>
        @else
        <form id="submit_form" action="/search/region" method="get">
            <select onchange="submit(this.form)" name="genre_id">
                <option value="" selected>All genre</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre['id'] }}">{{ $genre['genre'] }}</option>
                @endforeach
            </select>
            @if(!empty($region_id))
            <input type="hidden" name="region_id" value="{{ $region_id }}" />
            @endif
        </form>
        @endif
        <form action="/search/keyword" method="get">
            <button>検索</button>
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
        </form>
    </div>
    <div class="index__item">
        @foreach ($shops as $shop)
        <div class="index__card">
            <div class="card__img">
                <img src="{{ asset('/storage/image/' . $shop->image_path) }}" alt="{{$shop->image_path}}" />
            </div>
            <div class="card__content">
                <h2 class="card__content-ttl">
                    {{ $shop->name }}
                </h2>
                <div class="star">
                    <!-- 星関連 -->
                    @php
                    $shop_id = $shop->id;
                    $review= $average->
                    where('shop_id', $shop_id)->first();
                    if (!isset($review) ){
                    $star='--';
                    }else{
                    $stars=$review->stars;
                    $star = number_format($stars, 1);
                    }
                    @endphp
                    星{{ $star }}
                </div>
                <div class="card__content-tag">
                    <p class="card__content-tag-item">#{{ $shop->region->region }}</p>
                    <p class="card__content-tag-item">#{{ $shop->genre->genre }}</p>
                </div>
                <div class="card__content__detail">
                    <form class="card__content__form" action="/detail" method="get">
                        @csrf
                        <input type="hidden" name="id" value="{{ $shop->id }}">
                        <button class="card__button">詳しくみる</button>
                    </form>
                    @if (!isset($auth_id) )
                    @elseif( empty($shop->favorite) )
                    <form class="card__content__form" action="/favorites/create" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button class="card__button">登録</button>
                    </form>
                    @else
                    <form class="card__content__form" action="/favorites/delete" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button class="card__button">解除</button>
                    </form>
                    @endif

                </div>
                <div class="card__content__review">
                    <form class="card__content__form__review" action="/review" method="get">
                        @csrf
                        <input type="hidden" name="id" value="{{ $shop->id }}">
                        <button class="card__button">レビューをみる</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection