<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Question};

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Question $question)
    {
        $question->favorites()->attach($request->user()->id);

        return response()->json(null, 200);
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(\Auth::user()->id);

        return response()->json(null, 204);
    }
}
