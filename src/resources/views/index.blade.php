@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div>
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

<!-- ジャンル検索 -->
<div>
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
</div>



@foreach ($shops as $shop)
<div class="card">
    <div class="card__img">
        <img src="{{ asset('/storage/image/' . $shop->image_path) }}" alt="{{$shop->image_path}}" />
    </div>
    <div class="card__content">
        <h2 class="card__content-ttl">
            {{ $shop->name }}
        </h2>
        <div class="card__content-tag">
            <p class="card__content-tag-item">#{{ $regions[$shop->region_id-1]->region }}</p>
            <p class="card__content-tag-item">#{{ $genres[$shop->genre_id-1]->genre }}</p>
        </div>
        <form class="form" action="/detail" method="get">
            @csrf
            <input type="hidden" name="id" value="{{ $shop->id }}">
            <button class="date-nav__button">詳しくみる</button>
        </form>
        <div>
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
        <form class="form" action="/review" method="get">
            @csrf
            <input type="hidden" name="id" value="{{ $shop->id }}">
            <button class="date-nav__button">レビューをみる</button>
        </form>
    </div>


    @if (!isset($auth_id) ){
    echo('ログインしてないよ');
    }
    @elseif( empty($shop->favorite) )
    <form class="form" action="/favorites/create" method="post">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <button class="date-nav__button">登録</button>
    </form>
    @else
    <form class="form" action="/favorites/delete" method="post">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <button class="date-nav__button">解除</button>
    </form>
    @endif
</div>
@endforeach











@endsection