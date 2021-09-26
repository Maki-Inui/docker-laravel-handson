@extends('layouts.app')
@section('title', 'manpukuアプリ -プロフィール編集-')
@section('content')
<main class="flex content-center">
  <div class="wrapper w-4/5 lg:w-2/5">
    <form action="{{ route('mypage.update', Auth::id()) }}" method="POST">
      @csrf
      @method('PUT')
      @if(Auth::user()->area_id == 0)
      <div class="form-group">
        <label>よく行くエリアの設定</label>
        <select name="area_id">
          @foreach ($areas as $value)
          <option value="{{ $value->id }}">{{ $value->area_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>プロフィールの登録</label><br>
        <textarea class="w-full" name="profile" placeholder="プロフィール文を入力してください"></textarea>
      </div>
      <button class="mt-6 p-2 rounded bg-red-300 hover:bg-yellow-300 text-gray-800" type="submit">登録する</button>
      @else
      <h3>{{ Auth::user()->name }}さんの設定エリア</h3>
      <p class="mt-2">現在のエリア：{{ $area->area_name }} </p>
      <p>↓</p>
      <div class="form-group">
        <label>変更後のエリア</label>
        <select name="area_id">
          @foreach ($areas as $value)
          <option value="{{ $value->id }}">{{ $value->area_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>プロフィール</label><br>
        <textarea class="w-full" name="profile">{{ Auth::user()->profile }}</textarea>
      </div>
      <button class="mt-6 p-2 rounded bg-red-300 hover:bg-yellow-300 text-gray-800" type="submit">更新する</button>
      @endif
    </form>
    <p class="mt-6 text-center text-gray-400"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">マイページに戻る</p>
  </div>
</main>
@endsection