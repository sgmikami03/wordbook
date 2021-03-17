@extends('app')

@section('title', 'index')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

  <h2 class="text-muted"><small>タイトル:</small>{{ $article->title }}</h2>

  <h4 class="text-muted"><small>概要:</small>{{ $article->overview }}</h4>

  <h4 class="text-muted"><small>作成者:</small>{{ $article->user->name }}</h4>

  <a href="" class="btn btn-light">問題を解く</a>
  <a href="" class="btn btn-light">単語を覚える</a>

  @include("articles.wordbook_show")
@endsection