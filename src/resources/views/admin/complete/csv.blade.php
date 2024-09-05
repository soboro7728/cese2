@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="confirm_content">
    <p class="confirm_text">csvを読み込みました</p>
    <a href="/admin/dashboard" class="confirm_button">戻る</a>
</div>
@endsection