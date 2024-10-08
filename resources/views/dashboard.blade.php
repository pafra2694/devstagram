@extends('layouts.app')

@section('titulo')
    {{ $user->name }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="imagen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                <p class="text-gray-700 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal"> Seguidores</span>
                </p>

                <p class="text-gray-700 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Siguiendo</span>
                </p>

                <p class="text-gray-700 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Publicaciones</span>
                </p>
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if($posts->count())
            <div class="grid grid-cols-3 gap-6">
                @foreach ($posts as $post)
                <div class="">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen}}" alt="imagen del post {{ $post->titulo }}">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="my-10">
               {{ $posts->links() }} 
               {{-- Para poder ver los estilos es necesario modificar el archivo tailwind.config.js --}}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">Sin publicaciones aún</p>
        @endif
    </section>

@endsection