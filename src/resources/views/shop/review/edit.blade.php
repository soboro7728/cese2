@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review/post.css') }}">
@endsection


@section('content')


<div class="review__post">
    <h2 class="shop__content-ttl">
        {{ $shop->name }}のレビュー投稿
    </h2>
    @if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <form class="stars" action="/review/post/update" method="post" enctype="multipart/form-data">
        @csrf
        <span>
            <input id="review01" type="radio" name="stars" value="5" {{ "$review->stars" === "5"? 'checked="checked"' : '' }}><label for="review01">★</label>
            <input id="review02" type="radio" name="stars" value="4" {{ "$review->stars" === "4"? 'checked="checked"' : '' }}><label for="review02">★</label>
            <input id="review03" type="radio" name="stars" value="3" {{ "$review->stars" === "3"? 'checked="checked"' : '' }}><label for="review03">★</label>
            <input id="review04" type="radio" name="stars" value="2" {{ "$review->stars" === "2"? 'checked="checked"' : '' }}><label for="review04">★</label>
            <input id="review05" type="radio" name="stars" value="1" {{ "$review->stars" === "1"? 'checked="checked"' : '' }}><label for="review05">★</label>
        </span>
        <h4>口コミを投稿</h4>
        <textarea id="test2" type="text" name="comment" row="5">{{$review->comment}}</textarea>
        <br>
        <h4>画像を追加</h4>
        <div class="upload-area">
            <i class="fas fa-cloud-upload-alt"></i>
            <p1>クリックして写真を追加</p1>
            <br>
            <p2>またはドロッグアンドドロップ</p2>
            <br>
            <img class="preview__img" id="preview" src="{{ asset('/storage/image/' . $review->image_path) }}" alt="{{$review->image_path}}" style="max-width:200px;" />
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
        <input type="hidden" name="shop_id" value="{{ $review->shop_id }}">
        <input type="hidden" name="old_image" value="{{ $review->image_path }}">
        <button formaction="image">画像を削除する</button>
        <button>更新する</button>
    </form>
</div>

@endsection