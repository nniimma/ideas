<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    function show(Idea $idea)
    {
        // ? to shorten the code we can use compact('idea): return view('ideas.show', compact('idea'));
        return view('ideas.show', ['idea' => $idea]);
    }

    public function store()
    {

        // this is for validation of the form and the idea comes from name of the text area
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

    function destroy($id)
    {
        // dump is to check if the code is working:
        // todo: dump('deleting');
        // ! we check if the id of the rout is the same in the database and we get the one that is the same and then put it inside a variable, if we use get it means there are many data to get from database, or fail is for the times that there is no data with the same id, so it will give a 404 responce:
        $idea = Idea::where('id', $id)->firstOrFail();

        // ! to delete:
        $idea->delete();

        /*
            ? amother way to delete using binding rout(the variable should be match in the web.php):
            ? the way it works is it will find the primary key of the given database and then put it inside the given variable
            ? function destroy(Idea $Idea){
            ?   $idea->delete();
            ?}
        */

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully!');
    }
}
