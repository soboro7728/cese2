@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div>
    <form id="submit_form" action="/search/region" method="get">
        <select onchange="submit(this.form)" name="region_id">
            <option value="" selected>All area</option>
            @foreach ($regions as $region)
            <option value="{{ $region['id'] }}">{{ $region['region'] }}</option>
            @endforeach
        </select>
    </form>
</div>

@if(empty($shops))
からだよ
@else
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
@endif




</div>
@endforeach







<!-- <br>
    @php
    print($shop->name)
    @endphp

    <!-- 画像表示 -->
<br>
<!-- <img src="{{ asset('/storage/image/' . $shop->image_path) }}" alt="test.png"> -->
</div>
@endsection