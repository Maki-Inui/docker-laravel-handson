@extends('layouts.app')
@section('title', 'manpukuアプリ -お店の新規登録-')
@section('content')
<main>
  <div class="wrapper w-4/5 lg:w-2/5">
    <h3>新規のお店を登録する</h3>
    @include('layouts.error_message')
    <form method="post" action="{{ route('shops.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="shop_name">お店の名前</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
      </div>
      <div class="form-group">
        <label for="shop_area">エリア</label><br>
        <select name="area_id">
          @foreach ($areas as $value)
          <option value="{{ $value->id }}">{{ $value->area_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="shop_category">カテゴリー</label><br>
        <select name="category_id">
          @foreach ($categories as $value)
          <option value="{{ $value->id }}">{{ $value->category_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="descInput">説明文</label><br>
        <textarea class="w-5/6" name="description">{{ old('description') }}</textarea>
      </div>
      <p class="mt-6">画像は最大４つまでアップロード可能です</p>
      <div class="form-group">
        <input type="file" name="image[]" multiple>
      </div>
        <div class="form-group">
        <input type="file" name="image[]" id="image2" multiple>
      </div>
      <div class="form-group">
        <input type="file" name="image[]" id="image3" multiple>
      </div>
      <div class="form-group">
        <input type="file" name="image[]" id="image4" multiple>
      </div>
      <button class="mt-6 py-2 px-6 rounded bg-red-300 hover:bg-yellow-300 text-gray-800" type="submit">新規追加</button>
    </form>
  </div>
  <div class="mt-8 text-center text-gray-400">
    <a class="p-4" href="{{ route('shops.index') }}">お店一覧ページへ戻る</a>
  </div>
</main>
@endsection