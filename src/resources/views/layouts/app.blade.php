<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="logo">PiGLy</div>
    <div class="header-right">
      <a href="/weight_logs/goal_setting" class="header-btn">
        <img src="{{ asset('images/gear.png') }}" alt="設定" class="icon-img">
        目標体重設定
      </a>
      <form action="/logout" method="post" style="display: flex; align-items: center;">
        @csrf
        <button class="header-btn" type="submit" style="display: flex; align-items: center;">
            <img src="{{ asset('images/logout.png') }}" alt="ログアウト" class="icon-img">
            ログアウト
        </button>
    </form>
    </div>
  </header>

  @yield('content')
</body>

</html>