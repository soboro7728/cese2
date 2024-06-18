@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="shop">
    <div class="shop__img">
        <img src="{{ asset('/storage/image/' . $shop->image_path) }}" alt="{{$shop->image_path}}" />
    </div>
    <div class="shop__content">
        <h2 class="shop__content-ttl">
            {{ $shop->name }}
        </h2>
        <div class="shop__content-tag">
            <p class="shop__content-tag-item">#{{ $regions[$shop->region_id-1]->region }}</p>
            <p class="shop__content-tag-item">#{{ $genres[$shop->genre_id-1]->genre }}</p>
        </div>
        <div class="shop__content-detail">
            <p>{{ $shop->detail }}</p>
        </div>
    </div>
</div>
@if(isset($auths))
<div class="reservation">
    <div class="attendance__panel">
        <form action="/shop/confirm" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $shop->id }}">
            <input type="date" id="input_date" name="date" value="" required="required" onchange="inputCheck()" />
            <br>
            <select name="time" id="input_time" value="" required="required" onchange=" inputChecktime()" />
            <option " " selected>選択して下さい</option>
            @foreach ($shoptimes as $shoptime)
            <option value="{{ substr($shoptime['shoptime'], 0, 5) }}">{{ substr($shoptime['shoptime'], 0, 5) }}</option>
            @endforeach
            </select>
            <br>
            <input type="number" name="number" id="input_number" min="1" value="" required="required" onchange="inputChecknumber()" />
            <br>
            <button>登録</button>
        </form>
    </div>
    <div>
        <p id="date_check"></p>
        <p id="time_check"></p>
        <p id="number_check"></p>
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
@endsection