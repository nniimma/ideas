<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register()
    {
        return view('auth.register');
    }

    function store()
    {
        $validated = request()->validate([
            'name' => 'required',
            // ! users is the table and email is the row:
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('dashboard')->with('success', 'User registered successfully.');
    }
}
