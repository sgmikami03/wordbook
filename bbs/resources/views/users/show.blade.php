@extends('app')

@section('title', $user->name . 'のユーザーページ')

@section('nav')
  @include("nav", ['LinkCreation' => true])
@endsection

@section('content')

  <div class="card">
    <div class="card-body text-muted">
      <h2><i class="far fa-user-circle"></i> {{$user->name}}</h2>
      <h5>投稿した単語帳数:{{ count($articles) }}</h5>
    </div>
  </div>

  @foreach($articles as $article)
    @include("articles.card")
  @endforeach

@endsection