<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all()->sortByDesc();

        return view('articles.index', ['articles' => $articles]);
    }
}
