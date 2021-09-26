@extends('layouts.app')
@section('title', 'manpukuアプリ -フォローリスト-')
@section('content')
<main>
  <h3 class="text-center">{{ Auth::user()->name }}さんがフォロー中のユーザー</h3>
  <div>
    @if($follows->isEmpty())
    <p class="article w-4/5 lg:w-2/5 rounded-lg">フォロー中のユーザーはいません</p>
    @else
      @foreach($follows as $follow)
      <ul class="article w-4/5 lg:w-2/5">
        <li><a href="{{  route('users.show', $follow->id ) }}">{{ $follow->name }}</a></li>
        <li>よく行くエリア：{{ $follow->area_name }}</li>
      </ul>
      @endforeach
    @endif
  </div>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a></p>
</main>
@endsection