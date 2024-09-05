てすと
<form method="post" action="/" enctype="multipart/form-data">
    @csrf
    <label name="csvFile">csvファイル</label>
    <input type="file" name="csvFile" class="" id="csvFile" />
    <input type="submit"></input>
</form>
<a href="/">戻る</a>