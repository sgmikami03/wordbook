@extends('app')

@section('title', 'index')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

 <question
 :initial-word-list="{{ ($article->words) }}"
 :initial-is-english-to-japanese="{{ $isEnglishToJapanese }}"
 :initial-wordbook-id="{{ $article->id }}"
 :csrf="{{json_encode(csrf_token())}}"
 ></question>

@endsection