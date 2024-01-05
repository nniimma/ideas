<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashbordController::class, 'index'])->name('dashboard');

// ! prefix will help in instead of giving a prefix to each of the routes, it will give it as a group to all
// ! as will help in prefix for route names in the group
// ! we can have route groups inside routegroups
Route::group(['prefix' => 'ideas', 'as' => 'ideas.', 'middleware' => ['auth']], function () {
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show')->withoutMiddleware(['auth']);
    Route::post('', [IdeaController::class, 'store'])->name('store');
    // ! this middleware see if the person is logged in or not, if he was not logged in it will send it to log in page: 
    Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
    Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
    // todo: inside {} is a variable and we can pass value to it
    Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');
    Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// ? another way to do all the routes above (index, create, store, show, edit, update, destroy):
// ? if there are some methods that you do not use, you should use except:
// ? we can give middleware as well and not giving middlewarware with only method:
// todo: Route::resource('ideas', IdeaController::class)->except(['index', 'create'])->middleware('auth');
// todo: Route::resource('ideas', IdeaController::class)->only(['show']);
// ? this one is the same as the post comment above:
// todo: Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['show', 'edit', 'update', 'destroy'])->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::get('/terms', function () {
    return view('terms');
});
