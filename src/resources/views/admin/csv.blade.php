@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
csv読み込み画面
<form method="post" action="csv/import" enctype="multipart/form-data">
    @csrf
    <label name="csvFile">csvファイル</label>
    <input type="file" name="csvFile" class="" id="csvFile" />
    <input type="submit"></input>
</form>
@endsection