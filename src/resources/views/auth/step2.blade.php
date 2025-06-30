<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/step2.css') }}">
</head>

<body>
  <div class="background">
    <div class="register-box">
      <h1 class="title">PiGLy</h1>
      <h2 class="title-register">新規会員登録</h2>
      <p class="subtitle">STEP2 体重データの入力</p>
      <form class="form" action="/register/step2" method="post" novalidate>
        @csrf
        <label for="weight">現在の体重</label>
        <div class="input-unit">
          <input type="number" id="weight" name="weight" step="0.1" placeholder="現在の体重を入力">
          <span class="unit">kg</span>
        </div>
        @if ($errors->has('weight'))
          <div class="form__error">
            {{ $errors->first('weight') }}
          </div>
        @endif
        <label for="target_weight">目標の体重</label>
        <div class="input-unit">
          <input type="number" id="target_weight" name="target_weight" placeholder="目標の体重を入力">
          <span class="unit">kg</span>
        </div>
        @if ($errors->has('target_weight'))
          <div class="form__error">
            {{ $errors->first('target_weight') }}
          </div>
        @endif
        <button type="submit" class="register-button">アカウント作成</button>
      </form>
    </div>
  </div>
</body>