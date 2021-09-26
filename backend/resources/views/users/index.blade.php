@extends('layouts.app')

@section('title', 'manpukuアプリ -登録ユーザーリスト-')
@section('content')
<main>
  @if ($message = Session::get('failure'))
  <p style="color: red;">{{ $message }}</p>
  @endif
  <p class="text-center">登録ユーザー一覧</p>
  @foreach($all_users as $user)
  <ul class="article w-4/5 lg:w-2/5 rounded-lg">
    <li><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
  </ul>
  @endforeach
</main>
@endsection