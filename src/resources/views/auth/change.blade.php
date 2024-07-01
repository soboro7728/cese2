@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
予約変更ページだよ
<div class="reservation">
    <div class="attendance__panel">
        <label>予約店舗名: </label>
        {{ $reservation->shop->name }}
        <form action="/reservation/update" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $reservation->id }}">
            <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
            <label>予約日: </label>
            <input type="date" id="input_date" name="date" value="{{ $reservation->date }}" required="required" onchange="inputCheck()" />
            <br>
            <label>予約時間: </label>
            <select name="time" id="input_time" value="" required="required" onchange=" inputChecktime()" />
            <option " " selected>{{ substr($reservation['time'], 0, 5)}}</option>
            @foreach ($shoptimes as $shoptime)
            <option value="{{ substr($shoptime['shoptime'], 0, 5) }}">{{ substr($shoptime['shoptime'], 0, 5) }}</option>
            @endforeach
            </select>
            <br>
            <label>予約人数: </label>
            <input type="number" name="number" id="input_number" min="1" value="{{ $reservation->number }}" required="required" onchange="inputChecknumber()" />
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





@endsection