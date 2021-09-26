<header class="pt-4 flex justify-between items-center mx-3 lg:mx-40 xl:mx-40">
	<a href="{{ url('/') }}">
		<div class="flex items-center">
			<div class="w-12">
				<img src="{{ asset('image/spoon-fork.png') }}" alt="ロゴ">
			</div>
			<p class="ml-2 text-gray-500 text-4xl transition duration-300 hover:text-black">manpukuアプリ</p>
		</div>
	</a>
	<nav class="hidden lg:block">
		<ul class="flex">
			　<li class="menu border-l-2 pl-4"><a href="{{ url('/') }}">トップ</a></li>
			@auth
			<li class="menu ml-4"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">マイページ</a></li>
			<li class="menu ml-4"><a href="{{ route('mypage.visit.index', Auth::id()) }}">行ったお店</a></li>
			<li class="menu ml-4"><a href="{{ route('mypage.like.index', Auth::id()) }}">気になるお店</a></li>
			@endauth
			<li class="menu ml-4"><a href="{{ route('visited.index') }}">みんなが行ったお店</a></li>
			<li class="menu ml-4"><a href="{{ route('shops.index') }}">お店一覧</a></li>
		</ul>
	</nav>
	<div class="sp-menu lg:hidden" id="open">
		<i class="fas fa-bars fa-2x text-yellow-400"></i>
	</div>

	<div class="overlay fixed -inset-y-0 right-0">
		<i class="fas fa-times fa-2x text-yellow-400" id="close"></i>
		<div class="sp-menu-inner px-10">
			<nav>
				<ul class="pt-6">
					<li class="sp-menu_list"><a href="{{ url('/') }}">トップ</a></li>
					@auth
					<li class="sp-menu_list"><a href="{{ route('mypage.show', ['mypage' => Auth::id()]) }}">マイページ</a></li>
					<li class="sp-menu_list"><a href="{{ route('mypage.visit.index', Auth::id()) }}">行ったお店</a></li>
					<li class="sp-menu_list"><a href="{{ route('mypage.like.index', Auth::id()) }}">気になるお店</a></li>
					@endauth
					<li class="sp-menu_list"><a href="{{ route('shops.index') }}">お店一覧</a></li>
				</ul>
			</nav>
		</div>
	</div>
</header>