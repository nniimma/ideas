<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    function follow(User $user)
    {
        // ! follower is the user that is logged in:
        $follower = auth()->user();

        // ! follogings() is the relatioship name in user model:
        $follower->followings()->attach($user);

        return redirect()->route('users.show', $user->id)->with('success', 'Followed successfully!');
    }

    function unfollow(User $user)
    {
        $follower = auth()->user();

        $follower->followings()->detach($user);

        return redirect()->route('users.show', $user->id)->with('success', 'Unfollowed successfully!');
    }
}
