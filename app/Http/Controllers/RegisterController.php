<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        // dd($request->get('username'));

        //modificar el request para que la validación se realice correctamente
        $request->request->add(['username' => Str::slug($request->username)]); //slug elimina acentos, pasa a minúsculas y espacios los sustituye por guion medio

        //Validación incluida en laravel
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|max:20|min:3',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //creación de usuario
        User::create([
            'name' => $request->name,
            'username' => $request->username, //slug elimina acentos, pasa a minúsculas y espacios los sustituye por guion medio 
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Autenticar un usuario
        // Auth::attempt([
        //     'email' => $request->email, 
        //     'password' => $request->password
        // ]);

        //otra forma
        Auth::attempt($request->only('email','password'));
        
        //redireccionar
        return redirect()->route('post.index');

    }

        
}
