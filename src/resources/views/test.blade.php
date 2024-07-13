@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/test.css') }}">
@endsection

@section('content')
<!-- HTMLコード -->

<body>
    <header class="header">

        <!-- ハンバーガーメニュー部分 -->
        <div class="nav">

            <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
            <input id="drawer_input" class="drawer_hidden" type="checkbox">

            <!-- ハンバーガーアイコン -->
            <label for="drawer_input" class="drawer_open"><span></span></label>

            <!-- メニュー -->
            <nav class="nav_content">
                <ul class="nav_list">
                    <li class="nav_item"><a href="">メニュー1</a></li>
                    <li class="nav_item"><a href="">メニュー2</a></li>
                    <li class="nav_item"><a href="">メニュー3</a></li>
                </ul>
            </nav>

        </div>
        <div class="logo">Rese</div>
    </header>
</body>





@endsection