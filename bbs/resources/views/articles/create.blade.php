@extends('app')

@section('title', 'index')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

  <h2 class="text-muted">(作成者)の単語帳作成</h2>

  <form action="" name="wordbook">
    <label class="text-muted" for="title">タイトルを入力</label>
    <input type="text" name="title" class="form-control">
    <br>
    
    <create-wordbook></create-wordbook>

    <input type="hidden" name="user_id" value="">
  </form>

@endsection