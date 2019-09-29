<?php

namespace App\Http\Controllers;

use App\{Answer, Question};
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Question $question)
    {
        return $question->answers()->simplePaginate(3);
    }

    public function create(Question $question)
    {
        return view('answers.create', ['question' => $question]);
    }

    public function store(Request $request, Question $question)
    {
        $answer = $question->answers()->create($request->validate([
            'body' => 'required'
        ]) + ['user_id' => \Auth::user()->id]);

        return redirect()->route('questions.show', $question->slug)->with('success', 'your answer has been added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update($request->validate([
            'body' => 'required'
        ]));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'your answered has been updated',
                'body' => $answer->excerpt
            ]);
        }
        return redirect()->route('questions.show', $question->slug)->with('success', 'your answer has been updated');
    }

    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();

        return response()->json([
            'message' => 'your answer has been removed'
        ]);
    }
}
