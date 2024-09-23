<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="m-0 p-0">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevStagram - @yield("titulo")</title>
        @stack('styles')
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>

    <?php
        $messageHi = '';
        $hour = now()->hour; // Obtiene la hora actual (0-23)
        if ($hour >= 6 && $hour < 12) {
            $messageHi = '¡Buenos días!';
        } elseif ($hour >= 12 && $hour < 18) {
            $messageHi = '¡Buenas tardes!';
        } else {
            $messageHi = '¡Buenas noches!';
        }
    ?>

    <body class="bg-gray-100 min-h-screen">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                

                @auth
                    <h1 class="text-3xl font-black">
                        <a href="{{route('post.index', Auth::user()->username)}}">DevStagram</a>
                    </h1>
                    <nav class="flex gap-5 items-center">
                        <a href="{{ route('post.create') }}" class="flex items-center gap-1 bg-white border-2 border-gray-500 p-2 text-gray-600 rounded text-sm font-bold cursor-pointer shadow-md transition duration-300 hover:scale-105 hover:shadow-lg">
                            <svg class="h-5 w-5" dataSlot="icon" fill="none" strokeWidth={1.5} stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                            Crear
                        </a>

                        <a class="font-bold text-gray-600 text-sm transition duration-300 hover:scale-110" href="{{ route('post.index', Auth::user()->username) }}">
                            {{$messageHi}}<span class="font-normal"> {{Auth::user()->name}}</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf {{--Directiva sólo disponible en post--}}
                            <button type="submit" class="font-bold text-gray-600 text-sm transition duration-300 hover:scale-110">
                                Cerrar sesión
                            </button>
                        </form>
                    </nav>
                @endauth

                @guest
                    <h1 class="text-3xl font-black">
                        <a href="/">DevStagram</a>
                    </h1>
                    <nav class="flex gap-5 items-center">
                        <a class="font-bold text-gray-600 text-sm transition duration-300 hover:scale-110" href="{{route('login')}}">Login</a>
                        <a class="font-bold text-gray-600 text-sm transition duration-300 hover:scale-110" href="{{route('register')}}">Crear Cuenta</a>
                    </nav>
                @endguest

               
            </div>
        </header>
        
        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield("contenido")
        </main>

        <footer class="text-center p-5 mt-10 text-gray-500 font-bold uppercase text-xs">
            DevStagram - Todos los derechos reservados {{now()->year}}
        </footer>
        
    </body>
</html>