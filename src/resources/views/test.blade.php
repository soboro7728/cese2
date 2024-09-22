<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>



てすと
<form method="post" action="/" enctype="multipart/form-data">
    @csrf
    <label name="csvFile">csvファイル</label>
    <input type="file" name="csvFile" class="" id="csvFile" />
    <input type="submit"></input>
</form>
<a href="/">戻る</a>
// 赤色ハートのアイコンを表示
<p>いいね<i class="fas fa-heart" style="color: red;"></i></p>

// ダウンロードアイコンを表示
<p>csvダウンロード<i class="fas fa-download"></i></p>