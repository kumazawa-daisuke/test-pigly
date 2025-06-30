<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
  <div class="background">
    <div class="register-box">
      <h1 class="title">PiGLy</h1>
      <h2 class="title-register">新規会員登録</h2>
      <p class="subtitle">STEP1 アカウント情報の登録</p>
      <form class="form" action="{{ route('register.step1') }}" method="post" novalidate>
        @csrf
        <label for="name">お名前</label>
        <input type="name" id="name" name="name" value="{{ old('name') }}" placeholder="名前を入力">
        @if($errors->has('name'))
          <div class="form__error">
            {{ $errors->first('name') }}
          </div>
        @endif
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
        @if($errors->has('email'))
          <div class="form__error">
            {{ $errors->first('email') }}
          </div>
        @endif
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" placeholder="パスワードを入力">
        @if($errors->has('password'))
          <div class="form__error">
            {{ $errors->first('password') }}
          </div>
        @endif
        <button type="submit" class="next-button">次に進む</button>
      </form>

      <div class="login-link">
        <a href="/login">ログインはこちら</a>
      </div>
    </div>
  </div>
</body>