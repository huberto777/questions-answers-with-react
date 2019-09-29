<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Request $request, Answer $answer)
    {
        //dd('accept the answer');
        // $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);

        // if($request->expectsJson())
        // {
        // 	return response()->json([
        // 		'message' => 'you have accepted this answer as best answer'
        // 	]);
        // }

        return back();
    }
}
