<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function login2(Request $request){

        $user = User::where('usuario', $request->input_usuario);
     
        if ($user->exists()) {
            $user = $user->first();
            if (Hash::check($request->input_password, $user->password)) {
                return view('home');
            }
            else {
                return back()->with('Não foi possível efetuar o login, verifique o nome de usuário ou senha de acesso');
            }
        }
        else {
            return back()->with('Não foi possível efetuar o login, verifique o nome de usuário ou senha de acesso');
        }
    }

    public function login(Request $request) 
    {
        $credenciais = $request->only('usuario', 'password');

        if (Auth::attempt($credenciais)) {
            return redirect()->intended('home');
        }
        else {
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
