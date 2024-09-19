<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


//ruta sin usar controladores
Route::get('/', function () {
    return view('principal');
});


//-------------prueba
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    // petición de tipo get es cuando visitas un sitio
    Route::get('/register', [RegisterController::class,'index'])->name('register');
    // petición de tipo post es cuando envías información a un servidor
    Route::post('/register', [RegisterController::class,'store']);
});
//--------------------

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Peticion de tipo get para ir al muro 
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');