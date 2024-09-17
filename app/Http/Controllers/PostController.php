<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PostController extends Controller implements HasMiddleware
{
    //

    public static function middleware(): array
    {
        return [
             'auth',
            //new Middleware('auth', only: ['create']),
        ];
    }

    public function index()
    {
        $hour = now()->hour; // Obtiene la hora actual (0-23)
        $message = '';

        if ($hour >= 6 && $hour < 12) {
            $message = '¡Buenos días!';
        } elseif ($hour >= 12 && $hour < 18) {
            $message = '¡Buenas tardes!';
        } else {
            $message = '¡Buenas noches!';
        }

        return view('dashboard', ['message' => $message]);
    }

}

