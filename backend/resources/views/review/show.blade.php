@extends('layouts.app')

@section('title', 'manpukuアプリ -レビュー詳細-')
@section('content')
<main>
  <h2 class="text-center mb-6">お店レビューの詳細を表示しています</h2>
  <section class="article w-4/5 lg:w-2/5">
    <p class="text-3xl font-bold">{{ $review->shop->name }}の口コミ</p>
    <dl class="mt-4 lg:flex content-between text-gray-500">
      <div class="description flex mr-4">
        <dt>
          <h3>投稿者</h3>
        </dt>
        <dd><a href="{{ route('users.show', ['user' => $review->user_id]) }}">{{ $review->user->name }}さん</a>
        </dd>
      </div>
      <div class="recomend_score flex mr-4 mb-4">
        <dt>
          <h3>おすすめ度</h3>
        </dt>
        <dd>★ｘ{{ $review->recommend_score }}個</dd>
      </div>
      <div class="food_score flex">
        <dt>
          <h3>料理の満足度</h3>
        </dt>
        <dd>★ｘ{{ $review->food_score }}個</dd>
      </div>
    </dl>
    @if( $review->photos )
    <div class="swiper-container review-slider">
      <div class="swiper-wrapper">
        @foreach($review->photos as $photo)
        <div class="swiper-slide text-center">
          <img class="mx-auto h-auto block" src="{{ asset( 'image/review/' . $photo->path ) }}" alt="画像">
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
    @endif
    <dl class="mt-4 text-gray-500">
      <div class="description">
        <dt>
          <h3>タイトル</h3>
        </dt>
        <dd class="text-center">{{ $review->title }}</dd>
      </div>
      <div class="description">
        <dt>
          <h3>コメント</h3>
        </dt>
        <dd>{{ $review->comment }}</dd>
      </div>
    </dl>
  </section>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ route('shops.show', ['shop' => $review->shop_id]) }}">お店のレビュー一覧に戻る</a></p>
</main>
@endsection