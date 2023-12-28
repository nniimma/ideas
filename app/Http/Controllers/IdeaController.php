<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store()
    {

        request()->validate([
            'idea' => 'required|min:3|max:240'
        ]);

        /* 
            * this is to get the token:
            * dump($_POST);
            ! this is to get the request illuminate/HTTP/Request:
            ! dump(request());
            ! this one is to get a special part of request, the idea inside the get comes from the name of the erea in html that we gave and the second parameter is the default one:
            ! dump(request()->get('idea', 'null'));
        */
        $idea = new Idea([
            "content" => request()->get('idea', 'null'),
        ]);

        $idea->save();
        /*
            ! another way of code above (this one needs fillable as well):
            ? $idea = Idea::create([
            ? "content" => request()->get('idea', ''),
            ? ]);
        */
        /*
        ! to not going to a blank page while using post method: using redirect()->route()
        ? sending one time session that is deleted after the user see it: with('key', 'message')
        
     */
        return redirect()->route('dashboard')->with('success', 'Idea created successfully!');
    }
}
