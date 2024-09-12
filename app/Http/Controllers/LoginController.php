<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(!Auth::attempt($request->only('email','password'))) {
            return back()->with('mensaje','Credenciales Incorrectas'); //back vuelve a la página donde se envió el formulario sin necesidad de redireccionar
            /*
            - back() evita hacer redirección ya que regresa a la ruta donde se envió 
              inicialmente el formulario 
            - with() te permite enviar mensajes a la vista (en la vista se usan con session)  
            */
        }

        return redirect()->route('post.index');
    }
}
