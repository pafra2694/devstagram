<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
             'auth',
            //new Middleware('auth', only: ['create']),
        ];
    }

    public function index(User $user)
    {  
        //Código para obtener los posts del usuario...
        /**
         * Es posible usar la relación del modelo directamente en dashboard.blade (usando $user->posts) pero no se puede paginar
         * de esta manera, es por eso que se usa la siguiente forma.
         */
        $posts = Post::where('user_id', $user->id)->Paginate(6);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {   
        return view('posts.create');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //INSTERTAR REGISTRO
        //Insertar registro a BD
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => Auth::user()->id
        // ]);

        // OTRA FORMA DE INSTERTAR REGISTRO
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = Auth::user()->id;
        // $post->save();

        // OTRA FORMA DE INSTERTAR REGISTRO
        //Otra forma usando relaciones creadas en modelos
        $request->user()->posts()->create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $request->imagen,
                'user_id' => Auth::user()->id
        ]);


        //Redirección a post.index (o el muro del usuario autenticado)
        return redirect()->route('post.index',Auth::user()->username);

    }
}

