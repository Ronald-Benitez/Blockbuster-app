<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }
    public function loguear(Request $request){
        
        $request->validate([
            'username'=>'required|alpha_dash',
            'password'=>'required'
        ]);
        $usuario = Usuario::where('username','=',$request->username)->first();
        //USUSARIO NO ENCONTRADO
        if(empty($usuario)){
            $request->session()->put('alert', "danger");
            $request->session()->put('estado', "El usuario ".$request->username." no existe");
            return view('login.index');
        }
        //COMPROVACION DEL MISMO USERNAME
        if($usuario->username == $request->username){
            //COMPROVACION DE LA CONTRASEÑA
            if (password_verify($request->password,$usuario->password)){
                $request->session()->put([
                    'idUser'=>$usuario->id,
                    'username'=> $usuario->username,
                    'typeUser'=> $usuario->type,
                    'alert'=>"primary",
                    'estado'=>"¡ Bienvenido ".$usuario->username." !"
                ]);
                return redirect()->route('Pelicula.index');
            }else{
                $request->session()->put('alert', "danger");
                $request->session()->put('estado', "Contraseña incorrecta");
                return view('login.index');
            
            }
        }else{
            $request->session()->put('alert', "danger");
            $request->session()->put('estado', "El usuario ".$request->username." no existe");
            return view('login.index');
        }
    }
    public function logout(){
        session()->flush();
        session()->put('alert', 'success');
        session()->put('estado', '¡ Gracias por visitarnos !');  
        return redirect()->route('Pelicula.index');

    }
}
