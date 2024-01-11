<?php

// ! we can group our routes in different pages:

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ! guest middleware is opossite of auth middleware, when you are logged in you cant access it:
Route::group(['middleware' => ['guest']], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
