<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at');

        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->overview = $request->overview;
        $article->user_id = $request->user_id;
        $article->save();

        for ($i=0; $i < count($request->wordList_ja); $i++) { 
            \DB::table('words')->insert([
                'ja' => $request->wordList_ja[$i],
                'en' => $request->wordList_en[$i],
                'article_id' => $article->id
            ]);
        }

        return redirect()->route('index');
    }

    public function edit(Article $article)
    {
        //$editedWords = $article->editedWords();
        $editedWords = json_encode($article->words);
        return view("articles.edit", ["article" => $article, "editedWords" => $editedWords]);
    }
}
