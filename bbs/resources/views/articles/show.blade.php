@extends('app')

@section('title', 'index')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

  <h2 class="text-muted"><small>タイトル:</small>{{ $article->title }}</h2>

  <h5 class="text-muted"><small>概要:</small>{{ $article->overview }}</h5>

  <h5 class="text-muted"><small>回答数:</small>{{ $article->frequency }}</h5>

  <h5 class="text-muted"><small>作成者:</small>{{ $article->user->name }}</h5>

  <a href="{{ route('articles.solve', ['article' => $article, 'isEnglishToJapanese' => 1]) }}" class="btn btn-light">問題を解く(英語→日本語)</a>
  <a href="{{ route('articles.solve', ['article' => $article, 'isEnglishToJapanese' => 0]) }}" class="btn btn-light">問題を解く(日本語→英語)</a>

  @include("articles.wordbook_show", ["result" => false])
@endsection