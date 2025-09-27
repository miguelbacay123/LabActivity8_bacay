<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return redirect()->route('posts.index');
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'handleForm'])->name('register.submit');
Route::get('/success', [RegistrationController::class, 'success'])->name('register.success');