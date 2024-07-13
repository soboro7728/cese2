@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="confirm_content">
    <p class="confirm_text">ご予約ありがとうございます</p>
    <a href="/" class="confirm_button">戻る</a>
</div>
@endsection