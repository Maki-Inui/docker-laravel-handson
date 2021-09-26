@extends('layouts.app')
@section('title', 'manpukuアプリ -お店の編集-')
@section('content')
<main>
  <div class="wrapper w-4/5 lg:w-2/5">
    <h3>お店情報を編集する</h3>
    @include('layouts.error_message')
    <form action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label>お店の名前</label><br>
        <input type="text" name="name" value="{{ $shop->name }}">
      </div>
      <div class="form-group">
        <label>説明文</label><br>
        <textarea class="w-5/6" name="description">{{ $shop->description }}</textarea>
      </div>
      <button class="mt-6 py-2 px-6 rounded bg-red-300 hover:bg-yellow-300 text-gray-800" type="submit">更新する</button>
      <p class="mt-10">画像の追加と削除ができます<br>※最大４つまで</p>
    </form>
    @if ($message = Session::get('success'))
    <p class="text-indigo-800 font-bold">{{ $message }}</p>
    @endif
    @if($shop->has_image())
    <div class="flex flex-wrap justify-start mt-4 text-sm">
      @foreach($shop->images as $index => $image)
      <div class="shop-image-display w-5/12 lg:w-3/12">
        <div class="mx-auto my-0">
          <img class="mx-auto w-11/12 py-1" src="{{ asset( 'image/shop/' . $image->path ) }}" alt="画像">
        </div>
        <p class="text-center items-center self-center">画像{{ $index+1 }}</p>
        <div class="button-image-delete">
          <form action="{{ route('shops.image.destroy', ['shop' => $shop, 'image' => $image->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="icon-button" type="submit" value="削除する">削除<i class="fas fa-trash-alt"></i></button>
          </form>
        </div>
      </div>
      @endforeach
    </div>
    @endif
    @if($shop->images_count() < 4) <div class="lg:flex form-group">
      <form action="{{ route('shops.image.store', ['shop' => $shop]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button class="button-image-add" type="submit">画像を追加</button>
      </form>
  </div>
  @endif
  <p class="mt-6 text-gray-400"><a href="{{ route('shops.index') }}">お店一覧画面へ戻る</a></p>
  </div>
</main>
@endsection