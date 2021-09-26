@extends('layouts.app')

@section('title', 'manpukuアプリ -お店の詳細-')
@section('content')
<main>
  <p class="text-center p-4">お店の詳細ページです</p>
  <section class="article w-4/5 lg:w-2/5">
    <div class="relative">
      <div class="absolute top-0 right-0 text-right">
        @if (Auth::check())
        @if($has_shop_visit)
        <form action="{{ route('shops.visit.destroy', ['shop' => $shop, 'visit' => $has_shop_visit]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="icon-button" type="submit">来店済み<i class="fas fa-utensils"></i></button>
        </form>
        @else
        <form action="{{ route('shops.visit.store', ['shop' => $shop]) }}" method="POST">
          @csrf
          <button class="icon-button" type="submit">来店したらクリック<i class="fas fa-utensils"></i></button>
        </form>
        @endif
        @if($has_shop_like)
        <form action="{{ route('shops.like.destroy', ['shop' => $shop, 'like' => $has_shop_like]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="icon-button" type="submit">お気に入りのお店<i class="fas fa-heart"></i></button>
        </form>
        @else
        <form action="{{ route('shops.like.store', ['shop' => $shop]) }}" method="POST">
          @csrf
          <button class="icon-button" type="submit">気になるお店に登録<i class="far fa-heart"></i></button>
        </form>
        @endif
        @endif
      </div>
    </div>

    @if ($message = Session::get('success'))
    <p style="color: red;">{{ $message }}</p>
    @endif
    <div class="shop_name text-3xl font-bold mt-12 lg:mt-0">
      <h2>{{ $shop->name }}</h2>
    </div>
    <div class="flex mb-6">
      <div class="shop_area">
        <p>{{ $shop->area->area_name }}/</p>
      </div>
      <div class="shop_category">
        <p>{{ $shop->category->category_name }}</p>
      </div>
    </div>
    @if( $shop->images )
    <div class="swiper-container slider">
      <div class="swiper-wrapper">
        @foreach($shop->images as $image)
        <div class="swiper-slide text-center">
          <img class="mx-auto h-auto block" src="{{ asset( 'image/shop/' . $image->path ) }}" alt="画像">
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
    <div class="swiper-container slider-thumbnail">
      <div class="swiper-wrapper">
        @foreach($shop->images as $image)
        <div class="swiper-slide">
          <img class="mx-1 p-2 h-14 lg:h-16 block" src="{{ asset( 'image/shop/' . $image->path ) }}" alt="画像">
        </div>
        @endforeach
      </div>
    </div>
    @else
    <div class="mx-auto my-0 w-10/12"><img class="mx-auto" src="{{ url( 'https://placehold.jp/320x240.png?text=No Image' ) }}" alt="画像"></div>
    @endif
    <dl class="p-6 my-6 bg-yellow-100 rounded">
      <div class="description">
        <dt>
          <h3>お店情報</h3>
        </dt>
        <dd class="text-center">{{ $shop->description }}</dd>
      </div>
      <div class="recomend_score">
        <dt>
          <h3>おすすめ度</h3>
        </dt>
        <dd class="text-center">★ｘ{{ $shop->recommend_score }}個</dd>
      </div>
      <div class="food_score">
        <dt>
          <h3>料理の満足度</h3>
        </dt>
        <dd class="text-center">★ｘ{{ $shop->food_score }}個</dd>
      </div>
    </dl>
    @auth
    <button class="flex mt-8 p-3 mx-auto rounded bg-yellow-300 hover:bg-red-300 text-gray-800">
      <a href="{{ route('shops.review.create', ['shop' => $shop] ) }}">レビューを投稿する</a>
    </button>
    @endauth
  </section>
  <section class="w-4/5 lg:w-2/5 mt-6 mx-auto">
    <p class="pl-2 font-semibold">レビュー一覧</p>
    @if($reviews->isEmpty())
    <p>レビューがまだありません！</p>
    @else
    <div class="lg:flex content-between">
      @foreach($reviews as $review)
      <div class="article mx-auto w-4/5 lg:w-5/12 h-auto bg-white p-4 shadow border-t-4 border-red-400 text-gray-500 rounded-t-sm">
        <div class="text-red-400 text-center">
          <a href="{{ route('users.show', ['user' => $review->user_id]) }}">{{ $review->user->name }}さん</a>
        </div>
        <dl class="mt-2">
          <div class="recomend_score flex">
            <dt>
              <h3 class="mr-2">おすすめ度</h3>
            </dt>
            <dd>★ｘ{{ $review->recommend_score }}個</dd>
          </div>
          <div class="food_score flex">
            <dt>
              <h3 class="mr-2">料理の満足度</h3>
            </dt>
            <dd>★ｘ{{ $review->food_score }}個</dd>
          </div>
        </dl>
        <div class="description mt-2 flex">
          <dt>
            <h3 class="mr-2">タイトル</h3>
          </dt>
          <dd><a href="{{ route('shops.review.show', ['shop' => $shop, 'review' => $review->id]) }}">{{ $review->title }}</a></dd>
        </div>
        @if( $review->main_photo())
        <div class="mx-auto my-0 w-10/12"><img class="mx-auto" src="{{ asset( 'image/review/' . $review->main_photo()->path ) }}" alt="画像">
        </div>
        @else
        <div class="mx-auto my-0 w-10/12"><img class="mx-auto" src="{{ url( 'https://placehold.jp/320x240.png?text=No Image' ) }}" alt="画像">
        </div>
        @endif
        <div class="description h-28 mt-2">
          <dt>
            <h3>コメント</h3>
          </dt>
          <dd class="pl-4 truncate">{{ $review->comment }}</dd>
          <dd class="mt-2 text-center text-red-400"><a href="{{ route('shops.review.show', ['shop' => $shop, 'review' => $review->id]) }}">続きを読む</a></dd>
        </div>
        @if (Auth::check())
        <div class="text-right">
          @if(Auth::user()->hasReviewNice($review->id))
          @foreach($review->userNices as $nice)
          <form action="{{ route('shops.review.nice.destroy', ['shop' => $shop, 'review' => $review, 'nice' => $nice->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="icon-button" type="submit"><i class="fas fa-heart fa-lg text-red-400"></i></button>
          </form>
          @endforeach
          @else
          <form action="{{ route('shops.review.nice.store', ['shop' => $shop, 'review' => $review->id]) }}" method="POST">
            @csrf
            <button class="icon-button" type="submit"><i class="far fa-heart fa-lg text-red-400"></i></button>
          </form>
          @endif
          @endif
          @auth
        </div>
        @if ($review->user_id == Auth::id())
        <div class="flex">
          <div class="edit mr-4 text-xs">
            <a href="{{ route('shops.review.edit', ['shop' => $shop, 'review' => $review]) }}">編集<i class="fas fa-pencil-alt"></i></a>
          </div>
          <div class="delete text-xs">
            <form action="{{ route('shops.review.destroy', ['shop' => $shop, 'review' => $review]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="icon-button" type="submit" value="削除する">削除<i class="fas fa-trash-alt"></i></button>
            </form>
          </div>
        </div>
        @endif
        @endauth
      </div>
      @endforeach
    </div>
    @endif
  </section>
  <div class="mt-8 text-center text-gray-400">
    <a class="p-4" href="{{ route('shops.index') }}">お店一覧ページへ</a>
  </div>
</main>
@endsection