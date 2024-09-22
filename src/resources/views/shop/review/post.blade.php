@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review/post.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection


@section('content')
<div class="content">
    <div class="review__guide">
        <div class="review__guide__ttl">
            <h1 class="review__guide__txt">今回のご利用はいかがでしたか？</h1>
        </div>

        <div class="index__card">
            <div class="card__img">
                <img src="{{ asset('/storage/image/' . $shop->image_path) }}" alt="{{$shop->image_path}}" />
            </div>
            <div class="card__content">
                <h2 class="card__content-ttl">
                    {{ $shop->name }}
                </h2>
                <div class="card__content-tag">
                    <p class="card__content-tag-item">#{{ $shop->region }}</p>
                    <p class="card__content-tag-item">#{{ $shop->genre }}</p>
                </div>
                <div class="card__content__detail">
                    <form class="card__content__form" action="/detail" method="get">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button class="card__button">詳しくみる</button>
                    </form>
                    @if (!isset($auth_id) )
                    @elseif( empty($shop->favorite) )
                    <form class="card__content__form" action="/favorites/create" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit" class="favorites__button">
                            <i class="fas fa-heart fa-2x" style="color: grey;"></i>
                        </button>
                    </form>
                    @else
                    <form class="card__content__form" action="/favorites/delete" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit" class="favorites__button">
                            <i class="fas fa-heart fa-2x" style="color: red;"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="review__post">
        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
        <h2>体験を評価して下さい</h2>
        <form class="stars" id="action" action="/review/post/action" method="post" enctype="multipart/form-data">
            @csrf
            <span>
                <input id="review01" type="radio" name="stars" value="5"><label for="review01">★</label>
                <input id="review02" type="radio" name="stars" value="4"><label for="review02">★</label>
                <input id="review03" type="radio" name="stars" value="3"><label for="review03">★</label>
                <input id="review04" type="radio" name="stars" value="2"><label for="review04">★</label>
                <input id="review05" type="radio" name="stars" value="1"><label for="review05">★</label>
            </span>
            <h2>口コミを投稿</h2>
            <textarea class="comment__form" type="text" name="comment" value="{{ old('detail') }}"></textarea>
            <p class="comment__form__alt">0/400最高文字数</p>
            <br>
            <h2>画像の追加</h2>
            <div class="upload-area">
                <p1 class="upload-area__text1">クリックして写真を追加</p1>
                <br>
                <p2 class="upload-area__text2">またはドロッグアンドドロップ</p2>
                <br>
                <img class="preview__img" id="preview"  style="max-width:200px;">
                <input type="file" name="upload_file" id="input-files" accept='image/*' onchange="previewImage(this);">
            </div>
            <script>
                function previewImage(obj) {
                    var fileReader = new FileReader();
                    fileReader.onload = (function() {
                        document.getElementById('preview').src = fileReader.result;
                    });
                    fileReader.readAsDataURL(obj.files[0]);
                }
            </script>
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        </form>
    </div>
</div>
<div class="btnera">
    <input class="review__post__btn" type="submit" form="action" value="口コミを投稿">
</div>


@endsection