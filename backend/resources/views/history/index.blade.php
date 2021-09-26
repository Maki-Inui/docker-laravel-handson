@extends('layouts.app')
@section('title', 'your-shop_history')
@section('content')
<main>
  <h3 class="text-center">{{ Auth::user()->name }}さんのお店の閲覧履歴</h3>
  <div class="">
    @if($histories->isEmpty())
    <p class="article w-4/5 lg:w-2/5 rounded-lg">履歴はありません</p>
    @else
    @foreach($histories as $history)
    <ul class="article w-4/5 lg:w-2/5">
      <li class="text-2xl font-bold text-indigo-600"><a href="{{  route('shops.show', ['shop' => $history->shop_id]) }}">{{ $history->shop->name }}</a></li>
      <li>{{ $history->shop->area->area_name }}</li>
    </ul>
    @endforeach
    @endif
  </div>
  <p class="mt-6 text-center text-gray-400"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a></p>
</main>
@endsection