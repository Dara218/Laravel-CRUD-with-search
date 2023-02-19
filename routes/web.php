<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckActiveSession;

Route::get('/', [UserController::class, 'login'])->middleware('guest');

Route::get('/register', [UserController::class, 'register'])->middleware('guest');

Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser')->middleware('guest');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/loginUser', [UserController::class, 'loginUser'])->name('loginUser')->middleware('guest');

Route::get('/timeline', [UserController::class, 'timeline'])->name('timeline')->middleware('auth');

Route::post('/postProcess', [PostController::class, 'postProcess'])->name('postProcess');

Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
