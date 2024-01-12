<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Idea;
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
        $this->authorize('user.edit', $user->id);

        $ideas = $user->ideas()->paginate(3);
        return view('users.edit', compact('user', 'ideas'));
    }

    /*
     ! Update the specified resource in storage.
     ! laravel first perform the validation and if the validation get false it wont perform the update method (if we use the form request:)
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // ! if you put authorize true in the form request we should have line downside:
        // todo: $this->authorize('user.edit', $user->id);

        // ? first way to do the validations
        // todo: $validated = request()->validate([
        // todo:     'bio' => 'nullable|max:255',
        // todo:     'image' => 'image',
        // todo:     'name' => 'required'
        // todo: ]);

        // ? second way to do the validations form app/http/request/user/form request file:
        $validated = $request->validated();

        // ? this is the first method:
        // todo: if (request()->has('image')) {
        if ($request->has('image')) {
            // ! Get the existing image path
            $existingImagePath = $user->image;

            // ! in store you will tell where you want to store the photo(default is in storage/app/public):
            // ? first method:
            // todo: $imagePath = request()->file('image')->store('profile', 'public');
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            // ! Check if there was an existing image and delete it
            if ($existingImagePath && Storage::disk('public')->exists($existingImagePath)) {
                // ! this is for when we upload a new photo, the old photo be deleted:
                // ! ?? '' it is for the times that the image is null:
                Storage::disk('public')->delete($user->image ?? '');
            }
        }

        $user->update($validated);

        return redirect()->route('users.show', $user->id)->with('success', 'Changes successfully saved.');
    }


    // !  Remove the specified resource from storage.
    function destroy(User $user)
    {
        $this->authorize('user.edit', $user->id);

        Storage::disk('public')->delete($user->image ?? '');
        $user->update(['image' => null]);
        return redirect()->route('users.show', $user->id)->with('success', 'Image successfully deleted!');
    }


    function profile()
    {
        return $this->show(auth()->user());
    }
}
