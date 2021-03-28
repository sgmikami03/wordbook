<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view("articles.edit", ["article" => $article]);
    }

    public function update(Request $request)
    {
        $article = Article::where('id', $request->id)->first();

        $article->title = $request->title;
        $article->overview = $request->overview;
        $article->user_id = $request->user_id;
        $article->save();

        foreach($article->words as $word){
            if(!in_array($word->id ,$request->wordList_id)){
                \DB::table('words')->where('id', $word->id)->delete();
            }
        }

        for ($i=0; $i < count($request->wordList_id); $i++) {
            if (isset($request->wordList_id[$i])) {
                \DB::table('words')->where('id', $request->wordList_id[$i])
                  ->update(['ja'=> $request->wordList_ja[$i], 'en'=> $request->wordList_en[$i]]);
            }else{
                \DB::table('words')
                  ->insert(['ja'=> $request->wordList_ja[$i], 'en'=> $request->wordList_en[$i], 'article_id'=> $request->article]);
            }
        }
        
        return redirect()->route('articles.show', ['article' => $request->article]);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('index');
    }

    public function show(Article $article)
    {
        return view("articles.show", ["article" => $article]);
    }

    public function solve(Article $article, Request $request)
    {
        return view("articles.solve", ["article" => $article, "isEnglishToJapanese" => $request->isEnglishToJapanese]);
    }

    public function result(Request $request)
    {
        $article = Article::where('id', $request->id)->first();

        $frequency = $article->frequency + 1;
        $article->update(['frequency'=> $frequency]);

        $authUserId = Auth::user()->id;

        foreach($request->corrects as $key => $correct){
            if ($correct == "true") {
                $corrects[] = true;
                \DB::table('exercise_history')
                  ->insert(['user_id'=> $authUserId, 'word_id'=> $request->word_id[$key], 'isCorrect'=> 1]);
            }else{
                $corrects[] = false;
                \DB::table('exercise_history')
                  ->insert(['user_id'=> $authUserId, 'word_id'=> $request->word_id[$key], 'isCorrect'=> 0]);
            }
        }

        return view('articles.result',[
            'article' => $article,
            'isEnglishToJapanese' => $request->isEnglishToJapanese,
            'word_id' => $request->word_id,
            'ja' => $request->ja,
            'en' => $request->en,
            'corrects' => $corrects,
        ]);
    }
}
