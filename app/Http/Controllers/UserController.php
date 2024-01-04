<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $editing = true;
        $ideas = $user->ideas()->paginate(3);
        return view('users.show', compact('user', 'editing', 'ideas'));
    }

    /*
     ! Update the specified resource in storage.
     */
    public function update(User $user)
    {
        //
    }

    /*
    !  Remove the specified resource from storage.
     
    todo  function destroy(string $id)
    todo    {
        
    todo    }
    */
}
