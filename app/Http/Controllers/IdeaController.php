<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    function show(Idea $idea)
    {
        /*
            // it is to get all the comments:
            dd($idea->comments);
        */
        // ? to shorten the code we can use compact('idea): return view('ideas.show', compact('idea'));
        return view('ideas.show', ['idea' => $idea]);
    }

    function edit(Idea $idea)
    {
        // ? if the user is owner of the idea be able to edit it(first solution):
        // todo: if (auth()->id() !== $idea->user_id) {
        // todo:     abort(404, 'message you want!');
        // todo: }

        // ? if the user is owner of the idea be able to edit it(second solution: using gates):
        // todo: $this->authorize('idea.edit', $idea);

        // ? doing the same thing that gates do with policies:
        // ! update is the method we used in policies:
        $this->authorize('update', $idea);


        $editing = true;

        return view('ideas.show', ['idea' => $idea, 'editing' => $editing]);
    }

    function update(UpdateIdeaRequest $request, Idea $idea)
    {
        // ? if the user is owner of the idea be able to edit it(first solution):
        // todo: if (auth()->id() !== $idea->user_id) {
        // todo:     abort(404, 'message you want!');
        // todo: }

        // ? if the user is owner of the idea be able to edit it(second solution: using gates):
        // todo: $this->authorize('idea.edit', $idea);

        // ? doing the same thing that gates do with policies:
        // ! update is the method we used in policies:
        $this->authorize('update', $idea);

        /*
            request()->validate([
                'content' => 'required|min:3|max:240'
            ]);

            $idea->content = request()->get('content', '');
            $idea->save();
        */

        //? less code way to do update and get rid of security issues:
        // ? first way of doing the validation:
        // todo: $validated =             request()->validate([
        // todo:     'content' => 'required|min:3|max:240'
        // todo: ]);

        // ? second way of doing the validation:
        $validated = $request->validated();

        $idea->update($validated);
        // ? untill here

        return redirect()->route('dashboard')->with('success', 'Idea updated successfully!');
    }

    public function store(CreateIdeaRequest $request)
    {

        // this is for validation of the form and the idea comes from name of the text area
        // ? first way of doing the validation:
        // todo: $validated = request()->validate([
        // todo:     'content' => 'required|min:3|max:240'
        // todo: ]);

        // ? second way of doing the validation:
        $validated = $request->validated();

        // ! auth()->id()  will give the user's id:
        $validated['user_id'] = auth()->id();

        /* 
            * this is to get the token:
            * dump($_POST);
            ! this is to get the request illuminate/HTTP/Request:
            ! dump(request());
            ! this one is to get a special part of request, the idea inside the get comes from the name of the erea in html that we gave and the second parameter is the default one:
            ! dump(request()->get('idea', 'null'));
            ! another way:
            $idea = new Idea([
                "content" => request()->get('content', ''),
            ]);
    
            $idea->save();
        */
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
        // ! it is better to use validated ones for fillable, not to have security issues:
        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully!');
    }

    function destroy(Idea $idea)
    {
        // ! check if the person who put the idea is the same as the one who logged in:
        // ? if the user is owner of the idea be able to delete it(first solution):
        // todo: if (auth()->id() !== $idea->user_id) {
        // todo:     abort(404, 'message you want!');
        // todo: }

        // ? if the user is owner of the idea be able to delete it(second solution: using gates):
        // todo: $this->authorize('idea.edit', $idea);

        // ? doing the same thing that gates do with policies:
        // ! update is the method we used in policies:
        $this->authorize('update', $idea);


        // dump is to check if the code is working:
        // todo: dump('deleting');

        $idea->delete();


        /*
            ? another way to delete using binding rout(the variable should be match in the web.php):
            ? we check if the id of the rout is the same in the database and we get the one that is the same and then put it inside a variable, if we use get it means there are many data to get from database, or fail is for the times that there is no data with the same id, so it will give a 404 responce:
            ? $idea = Idea::where('id', $id)->firstOrFail();
            ? to delete:
            ? $idea->delete();
        */

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully!');
    }
}
