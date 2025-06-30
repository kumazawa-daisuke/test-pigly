@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<main>
  <div class="edit-box">
    <h2 class="form-title">Weight Log</h2>
    <form method="POST" action="{{ route('weight_logs.update', ['weightLogId' => $log->id]) }}" novalidate>
      @csrf
      <div class="form-group">
        <label for="date">日付</label>
        <input type="text" id="date" name="date" value="{{ \Carbon\Carbon::parse($log->date)->format('Y年n月j日') }}" readonly>
      </div>
      @if ($errors->has('date'))
        <div class="form__error">{{ $errors->first('date') }}</div>
      @endif
      <div class="form-group">
        <label for="weight">体重</label>
        <div class="input-unit">
          <input type="number" id="weight" name="weight" value="{{ old('weight', $log->weight) }}" step="0.1">
          <span class="unit">kg</span>
        </div>
        @if ($errors->has('weight'))
          <div class="form__error">{{ $errors->first('weight') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label for="calories">摂取カロリー</label>
        <div class="input-unit">
          <input type="number" id="calories" name="calories" value="{{ old('calories', $log->calories) }}">
          <span class="unit">cal</span>
        </div>
        @if ($errors->has('calories'))
          <div class="form__error">{{ $errors->first('calories') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label for="time">運動時間</label>
        <input type="time" id="time" name="exercise_time" value="{{ old('exercise_time', substr($log->exercise_time, 0, 5)) }}">
      </div>
      @if ($errors->has('exercise_time'))
        <div class="form__error">{{ $errors->first('exercise_time') }}</div>
      @endif
      <div class="form-group">
        <label for="content">運動内容</label>
        <textarea id="content" name="exercise_content" rows="3">{{ old('exercise_content', $log->exercise_content) }}</textarea>
      </div>
      @if ($errors->has('exercise_content'))
        <div class="form__error">{{ $errors->first('exercise_content') }}</div>
      @endif
      <div class="form-actions">
        <a href="{{ route('admin') }}" class="back-btn">戻る</a>
        <button type="submit" class="update-btn">更新</button>
    </form>
        <form method="POST" action="{{ route('weight_logs.destroy', ['weightLogId' => $log->id]) }}" onsubmit="return confirm('本当に削除しますか？');">
          @csrf
          @method('DELETE')
          <button type="submit" class="delete-btn">
          <img src="{{ asset('images/trash-icon.png') }}" alt="削除" style="width:24px; height:24px;">
          </button>
        </form>
      </div>
  </div>
</main>
@endsection