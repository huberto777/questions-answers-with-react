<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Question};

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($votable_id, $votable_type)
    {
        $type = "App\\". $votable_type;
        $votable = $type::findOrFail($votable_id);
        $votable->users()->attach(\Auth::user()->id);
        $votable->increment('votes_count');

        return response()->json(null, 200);
    }

    public function destroy($votable_id, $votable_type)
    {
        $type = "App\\". $votable_type;
        $votable = $type::findOrFail($votable_id);
        $votable->users()->detach(\Auth::user()->id);
        $votable->decrement('votes_count');

        return response()->json(null, 204);
    }
}
