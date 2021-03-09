@extends('app')

@section('title', 'index')

@section('content')

  @foreach($articles as $article)
    @include('articles.card')
  @endforeach

@endsection