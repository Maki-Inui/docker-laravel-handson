@extends('layouts.app')
@section('title', 'manpukuアプリ -行ったお店-')
@section('content')
<main>
  <h3 class="text-center">{{ Auth::user()->name }}さんの行ったお店一覧</h3>
  <div class="">
    @if($visits->isEmpty())
    <p class="article w-4/5 lg:w-2/5 rounded-lg">行ったお店はありません</p>
    @else
    @foreach($visits as $visit)
    <ul class="article w-4/5 lg:w-2/5">
      <li><a href="{{  route('shops.show', $visit->shop_id) }}">{{ $visit->shop->name }}</a></li>
      <li>{{ $visit->shop->area->area_name }}</li>
    </ul>
    @endforeach
    @endif
  </div>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a></p>
</main>
@endsection