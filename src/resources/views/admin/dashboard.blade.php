@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
管理者ログインできてるよ
<br>
<a href="dashboard/shop">店舗名登録</a>
<br>
<a href="dashboard/admin">店舗代表者登録</a>
<br>
<a href="dashboard/review">レビュー一覧</a>
<br>
<a href="dashboard/csv">CSV読み込み</a>
@endsection