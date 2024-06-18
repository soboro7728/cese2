@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="attendance__content">
    <div class="attendance__panel">
        <form action="/shop/create" method="post" enctype='multipart/form-data'>
            <input type="text" name="name" placeholder="例: 山田" value="{{ old('name') }}" />
            <br>
            <select name="region_id">
                @foreach ($regions as $region)
                <option value="{{ $region['id'] }}">{{ $region['region'] }}</option>
                @endforeach
            </select>
            <br>
            <select name="genre_id">
                @foreach ($genres as $genre)
                <option value="{{ $genre['id'] }}">{{ $genre['genre'] }}</option>
                @endforeach
            </select>
            <br>
            <input type="text" name="detail" placeholder="例: おいしいお店です。" value="{{ old('detail') }}" />
            <br>
            <input type="file" name="thumbnail" />
            <button>登録</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection