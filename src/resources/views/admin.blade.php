@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<input type="checkbox" id="modal-toggle" class="modal-toggle" hidden {{ ($errors->any() || session('show_modal')) ? 'checked' : '' }}>
@if ($errors->any() || session('show_modal'))
<div class="modal-overlay">
  <div class="modal-box">
    <h2>Weight Logを追加</h2>
    <form action="{{ route('weight_logs.store') }}" method="POST" novalidate>
      @csrf
      <div class="modal-form-group">
        <label>日付 <span class="required">必須</span></label>
        <input type="date" name="date" required value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
        @if($errors->has('date'))
          <div class="form__error">{{ $errors->first('date') }}</div>
        @endif
      </div>

      <div class="modal-form-group">
        <label>体重 <span class="required">必須</span></label>
      <div class="input-with-unit">
        <input type="number" name="weight" step="0.1" required>
        <span class="unit">kg</span>
      </div>
        @if($errors->has('weight'))
          <div class="form__error">{{ $errors->first('weight') }}</div>
        @endif
      </div>

      <div class="modal-form-group">
        <label>摂取カロリー <span class="required">必須</span></label>
        <div class="input-with-unit">
          <input type="number" name="calories" required>
          <span class="unit">cal</span>
        </div>
        @if($errors->has('calories'))
          <div class="form__error">{{ $errors->first('calories') }}</div>
        @endif
      </div>

      <div class="modal-form-group">
        <label>運動時間 <span class="required">必須</span></label>
        <input type="time" name="exercise_time">
        @if($errors->has('exercise_time'))
          <div class="form__error">{{ $errors->first('exercise_time') }}</div>
        @endif
      </div>

      <div class="modal-form-group">
        <label>運動内容</label>
        <textarea name="exercise_content" rows="3" placeholder="運動内容を入力"></textarea>
        @if($errors->has('exercise_content'))
          <div class="form__error">{{ $errors->first('exercise_content') }}</div>
        @endif
      </div>

      <div class="button-row center">
        <a href="{{ route('admin') }}" class="btn cancel">戻る</a>
        <button type="submit" class="btn submit">登録</button>
      </div>
    </form>
  </div>
</div>
@endif

<main>
  <section class="stats-card">
    <div class="stats-item">
      <div class="stats-label">目標体重</div>
      <div class="stats-value">{{ number_format($target_weight, 1) }} <span class="unit">kg</span></div>
    </div>
    <div class="stats-item">
      <div class="stats-label">目標まで</div>
      <div class="stats-value">{{ number_format($diff, 1) }} <span class="unit">kg</span></div>
    </div>
    <div class="stats-item">
      <div class="stats-label">最新体重</div>
      <div class="stats-value">{{ number_format($latest_weight, 1) }} <span class="unit">kg</span></div>
    </div>
  </section>

  <section class="data-section">
    <div class="data-search">
      <div class="search-block">
        <form method="GET" action="{{ route('weight_logs.search') }}" class="search-form">
          <input type="date" name="start_date" class="search-input" value="{{ request('start_date') }}">
          <span>～</span>
          <input type="date" name="end_date" class="search-input" value="{{ request('end_date') }}">
          <button type="submit" class="search-btn">検索</button>
          @if(request('start_date') || request('end_date'))
            <a href="{{ route('admin') }}" class="reset-btn">リセット</a>
          @endif
        </form>
        @if(request('start_date') && request('end_date'))
          <div class="search-result">
            {{ \Carbon\Carbon::parse(request('start_date'))->format('Y年n月j日') }}～{{ \Carbon\Carbon::parse(request('end_date'))->format('Y年n月j日') }}の検索結果　
            {{ $weight_logs->total() }}件
          </div>
        @endif
      </div>
      <form method="POST" action="{{ route('weight_logs.modal') }}">
      @csrf
        <button type="submit" class="add-btn">データ追加</button>
      </form>
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th>日付</th>
          <th>体重</th>
          <th>食事摂取カロリー</th>
          <th>運動時間</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach ($weight_logs as $log)
        <tr>
          <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
          <td>{{ $log->weight }}kg</td>
          <td>{{ $log->calories }}Cal</td>
          <td>{{ date('H:i', strtotime($log->exercise_time)) }}</td>
          <td>
            <a href="{{ route('weight_logs.detail', ['weightLogId' => $log->id]) }}">
            <img src="{{ asset('images/edit-icon.png') }}" alt="編集" class="edit-icon">
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div class="pagination-content">
      {{ $weight_logs->appends(request()->query())->links('pagination::custom') }}
    </div>
  </section>
</main>
@endsection