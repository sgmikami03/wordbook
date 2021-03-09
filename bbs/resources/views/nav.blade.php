<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand text-dark" href="#">みんなの単語帳</a>

  @if($LinkCreation)
  <div class="dropdown">
    <button class="btn btn-light btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
        menu
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#">home</a>
        <!--login中-->
        <a class="dropdown-item" href="#">投稿</a>
        <a class="dropdown-item" href="#"><i class="far fa-user-circle"></i>ユーザー名</a>
        <!--guest-->
        <a class="dropdown-item" href="#">login・新規</a>
        <a class="dropdown-item" href="#"><i class="far fa-user-circle"></i>guest</a>
      </div>
  </div>
  @endif
</nav>