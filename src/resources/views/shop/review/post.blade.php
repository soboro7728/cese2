@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review/post.css') }}">
@endsection


@section('content')

<h2 class="shop__content-ttl">
    {{ $shop->name }}のレビュー投稿
</h2>

<div class="review">
    @if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <form class="stars" action="/review/post/action" method="post" enctype="multipart/form-data">
        @csrf
        <span>
            <input id="review01" type="radio" name="stars" value="5"><label for="review01">★</label>
            <input id="review02" type="radio" name="stars" value="4"><label for="review02">★</label>
            <input id="review03" type="radio" name="stars" value="3"><label for="review03">★</label>
            <input id="review04" type="radio" name="stars" value="2"><label for="review04">★</label>
            <input id="review05" type="radio" name="stars" value="1"><label for="review05">★</label>
        </span>
        <h4>口コミを投稿</h4>
        <textarea class="comment__form" type="text" name="comment" value="{{ old('detail') }}"></textarea>
        <br>
        <h4>画像を追加</h4>
        <div class="upload-area">
            <i class="fas fa-cloud-upload-alt"></i>
            <p1>クリックして写真を追加</p1>
            <br>
            <p2>またはドロッグアンドドロップ</p2>
            <br>
            <img class="preview__img" id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
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
        <button>送信</button>
    </form>

    <!-- <form action="" method="POST" enctype="multipart/form-data">
        <div class="upload-area">
            <i class="fas fa-cloud-upload-alt"></i>
            <p1>クリックして写真を追加</p1>
            <br>
            <p2>またはドロッグアンドドロップ</p2>
            <br>
            <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
            <input type="file" name="upload_file" id="input-files">
        </div>
        <input type="submit" id="submit-btn" value="送信">
    </form> -->
</div>

@endsection