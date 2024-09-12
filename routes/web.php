<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('principal');
});


// petición de tipo get es cuando visitas un sitio
Route::get('/register', [RegisterController::class,'index'])->name('register');
// petición de tipo post es cuando envías información a un servidor
Route::post('/register', [RegisterController::class,'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// Peticion de tipo get para ir al muro 
Route::get('/muro', [PostController::class, 'index'])->name('post.index');
