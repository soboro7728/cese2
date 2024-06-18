test20240618
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>test</title>
</head>

<body>

    <!-- <br>
    <label>
        <input type="date" id="input_date" name="date" value="" required="required" onchange="inputCheck()" />
        <br>
        <input type="time" name="time" id="input_time" value="" required="required" onchange="inputChecktime()" />
        <br>
        <input type="number" name="number" id="input_number" min="1" value="" required="required" onchange="inputChecknumber()" />
        <br> </label>
    <p id="date_check"></p>
    <p id="time_check"></p>
    <p id="number_check"></p>
    <br>

    <script>
        function inputCheck() {
            var inputValue = document.getElementById("input_date").value;
            document.getElementById("date_check").innerHTML = 'Date  ：　' + inputValue;
        }

        function inputChecktime() {
            var inputValue = document.getElementById("input_time").value;
            document.getElementById("time_check").innerHTML = 'Time  ：　' + inputValue;
        }

        function inputChecknumber() {
            var inputValue = document.getElementById("input_date").value;
            document.getElementById("number_check").innerHTML = 'Number  ：　' + inputValue;
        }
    </script> -->
    <form id="submit_form" action="/">
        <select id="submit_item">
            <option value="人気順">人気順</option>
            <option value="新しい順">新しい順</option>
            <option value="古い順">古い順</option>
        </select>
    </form>

    <form action="/" method="get">
        @csrf
        <select onchange="submit(this.form)" type="search_year" name="search_year">
            <option value="人気順">人気順</option>
            <option value="新しい順">新しい順</option>
            <option value="古い順">古い順</option>
        </select>
    </form>
</body>

</html>