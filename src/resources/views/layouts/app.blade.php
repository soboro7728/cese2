<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="nav">
            <input id="drawer_input" class="drawer_hidden" type="checkbox">
            <label for="drawer_input" class="drawer_open"><span></span></label>
            <!-- メニュー -->
            @if( Auth::check() )
            <nav class="nav_content">
                <ul class="nav_list">
                    <li class="nav_item"><a href="/">Home</a></li>
                    <li class="nav_item">
                        <form class="form" action="/logout" method="post">
                            @csrf
                            <button class="link-style-btn">Logout</button>
                        </form>
                    </li>
                    <li class="nav_item"><a href="/mypage">Mypage</a></li>
                </ul>
            </nav>
            @else
            <nav class="nav_content">
                <ul class="nav_list">
                    <li class="nav_item"><a href="/">Home</a></li>
                    <li class="nav_item"><a href="/register">Registration</a></li>
                    <li class="nav_item"><a href="/login">Login</a></li>
                </ul>
            </nav>
            @endif
        </div>
        <div class="logo">Rese</div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>