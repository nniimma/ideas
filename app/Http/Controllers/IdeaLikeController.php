<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    function store(Idea $idea)
    {
        $liker = auth()->user();

        // ! we should get id but laravel does it automatucally: $liker->likes()->attach($idea->id);
        $liker->likes()->attach($idea);

        return redirect()->route('dashboard');
    }

    function distroy(Idea $idea)
    {
        $liker = auth()->user();

        // ! we should get id but laravel does it automatucally: $liker->likes()->attach($idea->id);
        $liker->likes()->detach($idea);

        return redirect()->route('dashboard');
    }
}
