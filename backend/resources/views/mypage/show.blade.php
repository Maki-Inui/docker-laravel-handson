@extends('layouts.app')
@section('title', 'manpukuアプリ -マイページ-')
@section('content')
<main>
  <h3 class="text-center">マイページ</h3>
  <section class="article w-4/5 lg:w-2/5 rounded-lg">
    <h3>こんにちは{{ Auth::user()->name }}さん</h3>
    <div class="flex">
      @if(Auth::user()->follows())
      <p>フォロー中<a class="text-indigo-600" href="{{  route('users.follow.index', Auth::id()) }}">{{ Auth::user()->followingsCount() }}</a>人</p>
      @endif
      @if(Auth::user()->hasFollowers())
      <p>フォロワー<a class="text-indigo-600" href="{{  route('followers.index', Auth::id()) }}">{{ Auth::user()->followedCount() }}</a>人</p>
      @endif
    </div>
    <ul class="mt-8">
      @if(Auth::user()->area_id == 0)
      <li>エリア未登録です <a href="{{  route('mypage.edit', Auth::id()) }}">登録はこちら</a></li>
      @else
      <li>よく行くエリア：{{ Auth::user()->area->area_name }} <a class="text-indigo-600" href="{{  route('mypage.edit', Auth::id()) }}">エリアを変更する(プロフィール編集)</a></li>
      @endif
      <li class="mt-2"><a href="{{  route('mypage.history.index', Auth::id()) }}">お店の閲覧履歴<i class="fas fa-store text-yellow-300"></i></a></li>
    </ul>
  </section>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ url('/') }}">トップページに戻る</a></p>
</main>
@endsection