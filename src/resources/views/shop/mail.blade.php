メール作成画面<br>
お気に入りの人全員にメール送信します。
<form action="mail" method="post">
    @csrf
    <label for="">件名</label>
    <input type="text" name="subject" value="{{ old('subject') }}">
    <br>
    <label for="">本文</label>
    <input type="text" name="text" value="{{ old('text') }}">
    <br>
    <p><input type="submit" value="送信" class="btn"></p>
</form>