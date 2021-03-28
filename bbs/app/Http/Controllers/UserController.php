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

        $exercise_history = \DB::table('exercise_history')->where('user_id', $request->user)->get();
        $correct_answer_rate = [];

        foreach($exercise_history as $one_of_exercise_history){
            if (in_array($one_of_exercise_history->word_id , array_column( $correct_answer_rate, 'word_id'))) {
                $key = array_search($one_of_exercise_history->word_id, array_column( $correct_answer_rate, 'word_id'));
                $correct_answer_rate[$key]['isCorrect'] += $one_of_exercise_history->isCorrect;
                $correct_answer_rate[$key]['numberSolved'] += 1;
            }else{
                $array = [
                    'word_id' => $one_of_exercise_history->word_id,
                    'isCorrect' => $one_of_exercise_history->isCorrect,
                    'numberSolved' => 1
                ];
                $correct_answer_rate[] = $array;
            }
        }
        
        $sort = [];
        for ($i=0; $i < count($correct_answer_rate); $i++) { 
            $correct_answer_rate[$i]['rate'] = round($correct_answer_rate[$i]['isCorrect'] / $correct_answer_rate[$i]['numberSolved'], 2);
            $sort[] = round($correct_answer_rate[$i]['isCorrect'] / $correct_answer_rate[$i]['numberSolved'], 2);
        }

        array_multisort($sort, SORT_ASC, $correct_answer_rate);

        $reviewWords = [];
        for ($i=0; $i < count($correct_answer_rate); $i++) {
            if($i == 10){
                break;
            }
            $reviewWords[] = \DB::table('words')->where('id', $correct_answer_rate[$i]['word_id'])->first();
        }
        
        return view('users.show', [
            'user'=> $user,
            'articles'=> $articles,
            'reviewWords'=> $reviewWords,
            'correct_answer_rate' => $correct_answer_rate
        ]);
    }
}
