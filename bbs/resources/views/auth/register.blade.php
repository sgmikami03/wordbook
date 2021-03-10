@extends('app')

@section('title', '新規登録')

@section('nav')
  @include("nav", ['LinkCreation' => false])
@endsection

@section('content')

<h2 id="page-title">新規登録</h2>

<form>
  <div class="form-group">
    <label for="email">メールアドレス</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="メールアドレス">
  </div>
  <div class="form-group">
    <label for="name">ユーザーネーム</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="ユーザーネーム">
  </div>
  <div class="form-group">
    <label for="password">パスワード</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="パスワード">
  </div>

  <a class="link" href="">loginはこちら</a>
  <br><br>

  <button type="submit" class="btn btn-primary">Submit</button>
  <!--google解放後
  <button type="googleで登録" class="btn btn-danger">googleで登録</button>
  -->
</form>

@endsection