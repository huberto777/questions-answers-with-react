<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Question, Answer};
use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        //\DB::enableQueryLog();
        $questions = Question::with(['user'])->latest()->paginate(5); // EAGER loading

        return view('questions.index', compact('questions')); //->render();

        //dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));

        return redirect()->route('questions.index')->with('success', 'your question has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //dd($question);
        $allAnswers = Answer::get();
        $question->increment('views'); //zwiększa licznik odwiedzin

        return view('questions.show', ['question' => $question, 'allAnswers' => $allAnswers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        /* GATE
        if(\Gate::denies('update-question', $question)) {

            abort(403, 'access denied');
        }
            return view('questions.create', compact('question'));
        */
        // POLICY
        $this->authorize('update', $question);
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        // if(\Gate::denies('update-question', $question)) {
        //     abort(403, 'access denied');
        // }

        // POLICY
        $this->authorize('update', $question);

        $question->update($request->only('title', 'body'));

        // if ($request->expectsJson()) {
        //     return response()->json([
        //         'message' => 'your question has been updated',
        //         'body' => $question->body_html
        //     ]);
        // }

        return redirect()->route('questions.index')->with('success', 'your question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // if(\Gate::denies('delete-question', $question)) {

        //     abort(403,'access denied');
        // }
        // POLICY
        $this->authorize('delete', $question);

        $question->delete();

        // if (request()->expectsJson()) {
        //     return response()->json([
        //         'message' => 'your question has been deleted'
        //     ]);
        // }

        return redirect('/questions')->with('alert', 'your question has been deleted');
    }
}
