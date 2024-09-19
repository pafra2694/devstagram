<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PostController extends Controller implements HasMiddleware
{
    //función que crea un mensaje de bienvenida personalizado que se muestra en el header al ser autenticado
    private function getGreetingMessage()
    {
        $hour = now()->hour; // Obtiene la hora actual (0-23)
        if ($hour >= 6 && $hour < 12) {
            return '¡Buenos días!';
        } elseif ($hour >= 12 && $hour < 18) {
            return '¡Buenas tardes!';
        } else {
            return '¡Buenas noches!';
        }
    }
    //
    public static function middleware(): array
    {
        return [
             'auth',
            //new Middleware('auth', only: ['create']),
        ];
    }

    public function index(User $user)
    {  
        //se genera el mensaje con la función 
        $message = $this->getGreetingMessage();

        return view('dashboard', [
            'user' => $user,
            'message' => $message,
        ]);
    }

    public function create()
    {
        //se genera el mensaje con la función 
        $message = $this->getGreetingMessage();
        
        return view('posts.create', ['message' => $message]);
    }

}

