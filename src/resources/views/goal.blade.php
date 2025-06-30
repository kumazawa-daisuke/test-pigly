@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal.css') }}">
@endsection

@section('content')
<main>
  <div class="center-box">
    <h2 class="form-title">目標体重設定</h2>
    <form method="POST" action="{{ route('goal.update') }}" novalidate>
      @csrf
      <div class="input-row">
        <input type="number" step="0.1" name="target_weight" value="{{ old('target_weight', $target->target_weight ?? '') }}">
        <span class="unit">kg</span>
        </div>
        @if($errors->has('target_weight'))
          <div class="form__error">{{ $errors->first('target_weight') }}</div>
        @endif
      <div class="form-actions">
        <a href="{{ route('admin') }}" class="back-btn">戻る</a>
        <button type="submit" class="update-btn">更新</button>
      </div>
    </form>
  </div>
</main>
@endsection