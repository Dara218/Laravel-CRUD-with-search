<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'register']);

Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/loginUser', [UserController::class, 'loginUser'])->middleware('guest')->name('loginUser');

Route::get('/timeline', [UserController::class, 'timeline'])->name('timeline')->middleware('auth');

Route::post('/postProcess', [PostController::class, 'postProcess'])->name('postProcess');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::delete('/deleteProcess/{id})', [PostController::class, 'deleteProcess'])->name('delete');

Route::put('/editPost/{id}', [PostController::class, 'editPost'])->name('edit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/searchPost', [PostController::class, 'search'])->name('search');
