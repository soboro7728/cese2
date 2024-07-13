@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/change.css') }}">
@endsection
@section('content')
<div class="reservation">
    <h1 class="reservation__ttl">予約変更</h1>
    <div class="attendance__panel">
        <label>店舗名</label><br>
        {{ $reservation->shop->name }}
        <br>
        <form action="/reservation/update" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $reservation->id }}">
            <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
            <label>予約日 </label>
            <input class="reservation__form" type="date" id="input_date" name="date" value="{{ $reservation->date }}" required="required" onchange="inputCheck()" />
            <br>
            <label>予約時間</label>
            <select class="reservation__form" name="time" id="input_time" value="" required="required" onchange=" inputChecktime()" />
            <option " " selected>{{ substr($reservation['time'], 0, 5)}}</option>
            @foreach ($shoptimes as $shoptime)
            <option value="{{ substr($shoptime['shoptime'], 0, 5) }}">{{ substr($shoptime['shoptime'], 0, 5) }}</option>
            @endforeach
            </select>
            <br>
            <label>予約人数 </label>
            <input class="reservation__form" type="number" name="number" id="input_number" min="1" value="{{ $reservation->number }}" required="required" onchange="inputChecknumber()" />
            <br>
            <div>
                <p id="date_check"></p>
                <p id="time_check"></p>
                <p id="number_check"></p>
            </div>
            <button class="reservation__panel__button">予約変更</button>
        </form>
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