<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $article->title }}</h5>
        <p class="card-text">投稿者:{{ $article->user->name }}</p>
        <p class="card-text">概要:{{ $article->overview }}</p>
        <a href="{{ route('articles.show', ['article' => $article]) }}" class="btn btn-light">詳細</a>        
        <a href="{{ route('articles.edit', ['article' => $article]) }}" class="btn btn-light">編集</a>
    </div>
</div>