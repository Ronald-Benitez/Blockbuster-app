<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\UseUse;
use Symfony\Contracts\Service\Attribute\Required;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('usuario.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required|alpha_dash',
            'password'=>'required'
        ]);
        $usuario = new Usuario();
        $usuario->username = $request->username;
        $usuario->password = password_hash($request->password,PASSWORD_DEFAULT);
        $usuario->type = "user";
        $usuario->save();

        session_start();
        $_SESSION["estado"]="¡ Usuario Agregado exitosamente !";
        $_SESSION["alert"]="success";
        return view('usuario.perfil', compact('usuario'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::where('id','=',$id)->first();
        if(empty($usuario)){//USUSARIO NO ENCONTRADO
            session_start();
            $_SESSION["estado"]="¡ El usuario con el id ".$id." no existe !";
            $_SESSION["alert"]="danger";
            return redirect()->route('Usuario.index');
        }
        return view('usuario.perfil', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = $this->existeUsuario($id);
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username'=>'required|alpha_dash',
            'type'=>'required',
            'password'=> 'required_with:cambiar',
        ]);
        
        $usuario = $this->existeUsuario($id);

        $data=([
            'username'=> $request->username,
            'password'=> password_hash($request->password,PASSWORD_DEFAULT),
            'type'=>$request->type
        ]);
        $usuario->update($data);
        $_SESSION["estado"]="¡ Usuario Editado con exito !";
        $_SESSION["alert"]="success";
        return view('usuario.perfil', compact('usuario'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = $this->existeUsuario($id);
        $usuario->delete();
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
                $_SESSION["estado"]="¡ Usuario Eliminado exitosamente !";
                $_SESSION["alert"]="danger";
            }
            return redirect()->route('Usuario.index');
    }

    public function existeUsuario($id){
        $usuario = Usuario::where('id','=',$id)->first();
        if(empty($usuario)){//USUSARIO NO ENCONTRADO
            session_start();
            $_SESSION["estado"]="¡ El usuario con el id ".$id." no existe !";
            $_SESSION["alert"]="danger";
            return redirect()->route('Usuario.index',"missing");
        }
        return $usuario;
    }
}
