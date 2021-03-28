<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = \DB::table('users')->where('id', $request->user)->first();
        $articles = Article::where('user_id', $request->user)->get();

        return view('users.show', ['user'=> $user, 'articles'=> $articles]);
    }
}
