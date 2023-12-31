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
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show');
Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');
// todo: inside {} is a variable and we can pass value to it
// ? if we use the rout binding method, we should use the same variable given in the controller: in this case $idea, so: {idea} instead of {id}
Route::delete('/ideas/{id}', [IdeaController::class, 'destroy'])->name('idea.destroy');

Route::get('/terms', function () {
    return view('terms');
});
