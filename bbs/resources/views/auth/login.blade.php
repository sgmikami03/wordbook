@extends('app')

@section('title', 'ログイン')

@section('nav')
  @include("nav", ['LinkCreation' => false])
@endsection

@section('content')

@include('error_card_list')

<h2 id="page-title">ログイン</h2>

<form method="POST" action="{{route('login')}}">
  @csrf
  <div class="form-group">
    <label for="email">メールアドレス</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="メールアドレス" required value="{{old('email')}}">
  </div>
  <div class="form-group">
    <label for="name">ユーザーネーム</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="ユーザーネーム" required value="{{old('name')}}">
  </div>
  <div class="form-group">
    <label for="password">パスワード</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="パスワード" required>
  </div>

  <label for="remember">自動ログインを有効にしますか？</label>
  <input type="checkbox" name="remember" id="remember" value="false">
  <br>

  <a class="link" href="{{ route('register') }}">新規登録はこちら</a>
  <br><br>

  <button type="submit" class="btn btn-primary">Submit</button>
  <!--google解放後
  <button type="googleで登録" class="btn btn-danger">googleで登録</button>
  -->
</form>

@endsection