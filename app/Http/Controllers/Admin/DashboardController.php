<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    function index()
    {
        // ! admin comes from service provider:
        // ? gates are the second way to give role for doing some fuctions
        // todo: if (!Gate::allows('admin')) {
        // todo:     abort(403);
        // todo: }

        // ? another way of code above:
        // todo: if (Gate::denies('admin')) {
        // todo:     abort(403);
        // todo: }
        // ? another way of code above:
        // ! inside authorize function we should give a gate name:
        // todo: $this->authorize('admin');

        return view('admin.dashboard');
    }
}
