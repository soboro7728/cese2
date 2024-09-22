@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection

@section('content')


<div class="index__content">
    <div class="search">
        <form class="search__form01" id="submit_form" action="/search" method="get">
            <select class="search__sort" onchange="submit(this.form)" name="condition_id">
                <option value="" selected>並び替え：評価高/低</option>
                @foreach ($conditions as $condition)
                @if(isset($condition_id))
                <option value="{{ $condition_id }}" @if($condition['id']==$condition_id) selected @endif>{{ $condition['condition'] }}</option>
                てすと
                @else
                <option value="{{ $condition['id'] }}">{{ $condition['condition'] }}</option>
                @endif
                @endforeach

            </select>
        </form>
        <div class="search__form">
            <form class="search" id="submit_form" action="/search" method="get">
                <select class="search__region" onchange="submit(this.form)" name="region">
                    <option value="" selected>All area</option>
                    @foreach ($regions as $region)
                    @if(isset($old_region))
                    <option value="{{ $region['region'] }}" @if($region['region']==$old_region) selected @endif>{{ $region['region'] }}</option>
                    @else
                    <option value="{{ $region['region'] }}">{{ $region['region'] }}</option>
                    @endif
                    @endforeach
                </select>
                <select class="search__genre" onchange="submit(this.form)" name="genre">
                    <option value="" selected>All genre</option>
                    @foreach ($genres as $genre)
                    @if(isset($old_genre))
                    <option value="{{ $genre['genre'] }}" @if($genre['genre']==$old_genre) selected @endif>{{ $genre['genre'] }}</option>
                    @else
                    <option value="{{ $genre['genre'] }}">{{ $genre['genre'] }}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" name="condition_id" value="{{ $condition_id }}">
            </form>
            <form class="search__keyword" action="/search/keyword" method="get">
                <button type="submit" class="search__keyword__btn">
                    <i class="fas fa-search"></i>
                </button>
                <input class="search__keyword__form" type="text" name="keyword" value="{{ old('keyword') }}">
                <input type="hidden" name="condition_id" value="{{ $condition_id }}">
                <input type="hidden" name="region" value="{{ $old_region }}">
                <input type="hidden" name="genre" value="{{ $old_genre }}">
            </form>
        </div>
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
                    <p class="card__content-tag-item">#{{ $shop->region }}</p>
                    <p class="card__content-tag-item">#{{ $shop->genre }}</p>
                </div>
                <div class="card__content__detail">
                    <form class="card__content__form" action="/detail" method="get">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button class="card__button">詳しくみる</button>
                    </form>
                    @if (!isset($auth_id) )
                    @elseif( empty($shop->favorite) )
                    <form class="card__content__form" action="/favorites/create" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit" class="favorites__button">
                            <i class="fas fa-heart fa-2x" style="color: grey;"></i>
                        </button>
                    </form>
                    @else
                    <form class="card__content__form" action="/favorites/delete" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit" class="favorites__button">
                            <i class="fas fa-heart fa-2x" style="color: red;"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection