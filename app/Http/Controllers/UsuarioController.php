<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsuarioController extends Controller
{
    public function list_users(){
        $usuarios = User::get_all_users();
        return response()->json($usuarios);
    }

    public function search_user($req){
        $usuario = User::get_user($req);
        return response()->json($usuario);
    }

    public function login(Request $request){
        //dd($request);
        
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            return response()->json(['message'=>'Autenticacion exitosa','user'=>$user]);            
        }else{
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }
    }

    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
    
}
