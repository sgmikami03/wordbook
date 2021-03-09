@extends('app')

@section('title', 'index')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

  @foreach($articles as $article)
    @include('articles.card')
  @endforeach

@endsection