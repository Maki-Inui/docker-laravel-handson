@extends('layouts.app')
@section('title', 'manpukuアプリ -人気のお店-')
@section('content')
<main>
  <h3 class="text-center">みんなが来店したお店一覧</h3>
  <p class="text-center">(来店した人数が多い順)</p>
  <div class="text-center">
    @if($shops->isEmpty())
    <p class="article w-4/5 lg:w-2/5 rounded-lg">来店履歴はありません</p>
    @else
    @foreach($shops as $shop)
    <div class="article bg-white w-4/5 lg:w-2/5 mt-10 mx-auto p-10 shadow">
      <a href="{{ route('shops.show', $shop->id) }}">
        <h3 class="text-3xl pb-1 font-bold text-indigo-600">{{$shop->id}}:{{$shop->name}}</h3>
        <div class="flex justify-center">
          <div class="shop_area">
            <p>{{ $shop->area->area_name }}/</p>
          </div>
          <div class="shop_category">
            <p>{{ $shop->category->category_name }}</p>
          </div>
        </div>
        <ul class="py-6">
          <li>おすすめ度→★ｘ{{ $shop->recommend_score }}個</li>
          <li>料理の満足度→★ｘ{{ $shop->food_score }}個</li>
        </ul>
        @if( $shop->has_image() )
        <div class="mx-auto my-0 w-10/12"><img class="mx-auto lx:w-11/12" src="{{ asset( 'image/shop/' . $shop->main_image()->path ) }}" alt="画像"></div>
        @else
        <div class="mx-auto my-0 w-10/12"><img class="mx-auto lx:w-11/12" src="{{ url( 'https://placehold.jp/320x240.png?text=No Image' ) }}" alt="画像"></div>
        @endif
    </div>
    @endforeach
    @endif
  </div>
  <div class="mt-10 text-center text-gray-400"><a href="{{ url('/') }}">トップページに戻る</a></div>
</main>
@endsection