@extends('app')

@section('title', 'index')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

  <h2 class="text-muted">{{ Auth::user()->name }}の単語帳修正</h2>

  <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}" name="wordbook">
    @csrf
    @method('PATCH')

    <label class="text-muted" for="title">タイトルを入力</label>
    <input type="text" name="title" class="form-control" value="{{ $article->title }}">
    <br>

    <label for="overview" class="text-muted">概要入力</label>
    <textarea name="overview" cols="30" rows="2" class="form-control">{{ $article->overview }}</textarea>
    <br>
    
    <create-wordbook v-bind:initial-word-list={{ ($article->words) }}></create-wordbook>

    <input type="hidden" name="id" value="{{ $article->id }}">
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
  </form>

@endsection