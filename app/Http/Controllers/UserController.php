<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /*
    ?  Display a listing of the resource.
     
    todo    public function index()
    todo    {
        
    todo    }

    !  Show the form for creating a new resource.
     
    todo    public function create()
    todo    {
            
    todo    }
    
    
    !  Store a newly created resource in storage.
     
    todo    public function store(Request $request)
    todo    {
        
    todo    }
    */

    /*
     ! Display the specified resource.
     */
    public function show(User $user)
    {
        // todo: if we want we can do the ordered by after ideas: ideas()->orderBy('created_at', 'DESC')
        // todo: ->orderBy('created_at', 'DESC') = ->latest()
        // todo: we can do this in model in the relationships as well
        $ideas = $user->ideas()->paginate(3);

        return view('users.show', compact('user', 'ideas'));
    }

    /*
     ! Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $ideas = $user->ideas()->paginate(3);
        return view('users.edit', compact('user', 'ideas'));
    }

    /*
     ! Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = request()->validate([
            'bio' => 'nullable|max:255',
            'image' => 'image',
            'name' => 'required'
        ]);


        if (request()->has('image')) {
            // ! in store you will tell where you want to store the photo(default is in storage/app/public):
            $imagePath = request()->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            // ! this is for when we upload a new photo, the old photo be deleted:
            Storage::disk('public')->delete($user->image);
        }

        $user->update($validated);

        return redirect()->route('users.show', $user->id)->with('success', 'Changes successfully saved.');
    }

    /*
    !  Remove the specified resource from storage.
     
    todo  function destroy(string $id)
    todo    {
        
    todo    }
    */

    function profile()
    {
        return $this->show(auth()->user());
    }
}
