<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand text-dark" href="{{ route('index') }}">みんなの単語帳</a>

  @if($LinkCreation)
  <div class="dropdown">
    <button class="btn btn-light btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
        menu
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{ route('index') }}">home</a>

        <!--login中-->
        @auth
        <a class="dropdown-item" href="{{ route('articles.create') }}">投稿</a>
        <a class="dropdown-item" href="{{ route('users.show', ['user'=> Auth::user()->id]) }}"><i class="far fa-user-circle"></i>{{ Auth::user()->name }}</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dropdown-item" type="submit">ログアウト</button>
        </form>
        @endauth

        <!--guest-->
        @guest
        <a class="dropdown-item" href="{{ route('register') }}">login・新規</a>
        <a class="dropdown-item" href="#"><i class="far fa-user-circle"></i>guest</a>
        @endguest
      </div>
  </div>
  @endif
</nav>