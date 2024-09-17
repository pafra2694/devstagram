<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="m-0 p-0">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevStagram - @yield("titulo")</title>
        @vite('resources/css/app.css')

    </head>
    <body class="bg-gray-100 min-h-screen">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    <a href="/">DevStagram</a>
                </h1>

                @auth
                    <nav class="flex gap-5 items-center">
                        <a class="font-bold text-gray-600 text-sm transition duration-300 hover:scale-110" href="#">{{$message}}<span class="font-normal"> {{Auth::user()->username}}</span></a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf {{--Directiva sólo disponible en post--}}
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm transition duration-300 hover:scale-110">
                                Cerrar sesión
                            </button>
                        </form>
                    </nav>
                @endauth

                @guest
                    <nav class="flex gap-5 items-center">
                        <a class="font-bold uppercase text-gray-600 text-sm transition duration-300 hover:scale-110" href="#">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm transition duration-300 hover:scale-110" href="{{route('register')}}">Crear Cuenta</a>
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