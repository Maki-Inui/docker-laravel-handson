@extends('layouts.app')

@section('title', 'manpukuアプリ -ユーザー情報-')
@section('content')
<main>
  <p class="text-center">プロフィール</p>
  <section class="article w-4/5 lg:w-2/5 rounded-lg">
    <p>{{$user->name}}さん</p>
    @if (Auth::check())
    @if(Auth::id() !== $user->id)
    @if(empty($following))
    <form action="{{ route('users.follow.store', $user->id) }}" method="POST">
      @csrf
      <button class="icon-button" type="submit">フォローする<i class="fas fa-user-plus"></i></button>
    </form>
    @else
    <form action="{{ route('users.follow.destroy', ['user' => $user->id, 'follow' => $following->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="icon-button" type="submit">フォロー解除<i class="fas fa-user-minus"></i></button>
    </form>
    @endif
    @endif
    @if($followed)
    <p style="color:pink;">{{ $user->name }}さんにフォローされています</p>
    @endif
    @endif
    @if($user->area_id == 0)
    <p>エリア登録なし</p>
    @else
    <p>よく行くエリア：{{ $user->area->area_name }}</p>
    @endif
    @if($user->profile !== null)
    <p>{{ $user->profile }}</p>
    @endif
  </section>
  <p class="mt-6 text-gray-400 text-center"><a href="{{ url()->previous() }}">前のページに戻る</a></p>
</main>
@endsection