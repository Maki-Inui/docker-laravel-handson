@extends('layouts.app')

@section('title', 'manpukuアプリ -レビュー投稿-')
@section('content')
<main>
  <div class="wrapper w-4/5 lg:w-2/5">
  <h3>レビューを投稿しよう</h3>
  @include('layouts.error_message')
  <form action="{{ route('shops.review.store', $shop) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="shop_id" type="hidden" value="{{ $shop }}">
    <div class="form-group">
      <p>おすすめ度</p>
        <input type="radio" name="recommend_score" value="1">
        <label for="1">1</label>
        <input type="radio" name="recommend_score" value="2">
        <label for="1">2</label>
        <input type="radio" name="recommend_score" value="3" checked>
        <label for="1">3</label>
        <input type="radio" name="recommend_score" value="4">
        <label for="1">4</label>
        <input type="radio" name="recommend_score" value="5">
        <label for="1">5</label>
    </div>
    <div class="form-group">
      <p>料理の満足度</p>
        <input type="radio" name="food_score" value="1">
        <label for="1">1</label>
        <input type="radio" name="food_score" value="2">
        <label for="1">2</label>
        <input type="radio" name="food_score" value="3" checked>
        <label for="1">3</label>
        <input type="radio" name="food_score" value="4">
        <label for="1">4</label>
        <input type="radio" name="food_score" value="5">
        <label for="1">5</label>
    </div>
    <div class="form-group">
      <label>投稿タイトル</label><br>
      <input type="text" name="title" value="{{ old('title') }}">
    </div>
    <div class="form-group">
      <label>レビュー</label><br>
      <textarea class="w-5/6" name="comment">{{ old('comment') }}</textarea>
    </div>
    <div class="form-group">
      <p>写真は最大４つまでアップロード可能です</p>
      <input type="file" name="image[]" id="image1" multiple>
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
    <button class="mt-6 p-2 rounded bg-red-300 hover:bg-yellow-300 text-gray-800" type="submit">登録する</button>
  </form>
  <p class="mt-6 text-gray-400"><a href="{{ route('shops.show', ['shop' => $shop]) }}">お店情報へ戻る</a></p>
  </div>
</main>
@endsection