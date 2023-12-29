<?php

use App\Http\Controllers\DashbordController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [DashbordController::class, 'getDashboard'])->name('dashboard');
Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
// todo: inside {} is a variable and we can pass value to it
Route::delete('/ideas/{id}', [IdeaController::class, 'destroy'])->name('idea.destroy');

Route::get('/terms', function () {
    return view('terms');
});
