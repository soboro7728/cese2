@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

店舗管理者ログインできてるよ
<br>
<a href="dashboard/shop">店舗情報登録</a>
<br>
<a href="dashboard/reservation">予約確認</a>
<br>
<a href="dashboard/mail">メール作成</a>

@endsection