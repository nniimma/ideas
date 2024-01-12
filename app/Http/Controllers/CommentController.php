<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function store(CreateCommentRequest $request, Idea $idea)
    {

        // ? first way to creat a new comment:
        /*
        todo:    $comment = new Comment();
        todo:    $comment->idea_id = $idea->id;
        todo:    $comment->user_id = auth()->id();
        todo:    $comment->content = request()->get('content');
        todo:    $comment->save();
        */

        // ? second way:
        // ? first way of validation
        // todo:    $validated = request()->validate([
        // todo:        'content' => 'required',
        // todo:    ]);

        // ? second way of validation using form request:
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        $validated['idea_id'] = $idea->id;
        // dd($validated);

        Comment::create($validated);

        return redirect()->route('dashboard')->with('success', 'Comment posted successfully.');
    }
}
