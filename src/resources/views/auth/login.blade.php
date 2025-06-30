<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
  <div class="background">
    <div class="login-box">
      <h1 class="title">PiGLy</h1>
      <p class="subtitle">ログイン</p>
      <form class="form" action="/login" method="post" novalidate>
        @csrf
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" placeholder="メールアドレスを入力">
        @if($errors->has('email'))
          <div class="form__error">{{ $errors->first('email') }}</div>
        @endif
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" placeholder="パスワードを入力">
        @if($errors->has('password'))
          <div class="form__error">{{ $errors->first('password') }}</div>
        @endif
        <button type="submit" class="login-button">ログイン</button>
      </form>

      <div class="register-link">
        <a href="/register/step1">アカウント作成はこちら</a>
      </div>
    </div>
  </div>
</body>