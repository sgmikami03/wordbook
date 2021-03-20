@extends('app')

@section('title', '結果発表')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

  <h2 class="text-muted"><small>タイトル:</small>{{ $article->title }}</h2>

  <h4 class="text-muted"><small>概要:</small>{{ $article->overview }}</h4>

  <h4 class="text-muted"><small>作成者:</small>{{ $article->user->name }}</h4>


  <a href="{{ route('index') }}" class="btn btn-light">topへ</a>
  <br><br>
  <a href="{{ route('articles.solve', ['article' => $article, 'isEnglishToJapanese' => 1]) }}" class="btn btn-light">リトライ(英語→日本語)</a>
  <a href="{{ route('articles.solve', ['article' => $article, 'isEnglishToJapanese' => 0]) }}" class="btn btn-light">リトライ(日本語→英語)</a>

  @include("articles.wordbook_show", ['result' => true])
@endsection