@extends('layouts.app')
@section('title', 'manpukuアプリ -フォロワーリスト-')
@section('content')
<main>
  <h3 class="text-center">{{ Auth::user()->name }}さんをフォロー中のユーザー</h3>
  <div>
    @if($followers->isEmpty())
    <p class="article w-4/5 lg:w-2/5 rounded-lg">フォロワーはいません</p>
    @else
      @foreach($followers as $follower)
      <ul class="article w-4/5 lg:w-2/5">
        <li><a href="{{  route('users.show', $follower->id ) }}">{{ $follower->name }}</a></li>
        <li>よく行くエリア：{{ $follower->area_name }}</li>
      </ul>
      @endforeach
    @endif
  </div>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">mypageへ戻る</a></p>
</main>
@endsection