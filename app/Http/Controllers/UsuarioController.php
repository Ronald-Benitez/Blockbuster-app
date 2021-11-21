<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Reservacion;
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
        $usuarios = Usuario::all();
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
        $flag=false;
        $request->validate([
            'username'=>'required|alpha_dash',
            'password'=>'required'
        ]);
        $usuario = new Usuario();
        $usuario->username = $request->username;
        $usuario->password = password_hash($request->password,PASSWORD_DEFAULT);
        $usuario->type = "user";
        if(!empty($request->type)){
            $flag=true;
            $usuario->type = $request->type;
        }

        //Si ya existe el usuario
        $user = Usuario::where('username','=',$request->username)->first();
        if(!empty($user)){
            session()->put('alert', "danger");
            session()->put('estado', "El usuario ".$request->username." ya existe!");
            return redirect()->route('Usuario.create');
        }
        $usuario->save();
        //mensaje de Exito
        session()->put('alert', "success");
        session()->put('estado', "¡ Usuario Agregado con exito !");
        if($flag){
            return redirect()->route('Usuario.index');
        }
        return redirect()->route('Pelicula.index');
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

            return redirect()->route('Usuario.index');
        }
        //LLamado de las siguientes tablas
        //likes
        $likes = DB::table('likes')
                    ->join('peliculas', 'peliculas.id', '=', 'likes.idMovie')
                    ->select('peliculas.id', 'peliculas.name',)
                    ->where('likes.idUser',$id)
                    ->get();
        //Compras de peliculas
        $compras = DB::table('compras')
                    ->select('idMovie', 'created_at','name','buyP','id')
                    ->where('compras.idUser','=',$id)
                    ->orderBy('id','asc')
                    ->get();

        //Reservaciones de peliculas
        $reservacion = DB::table('reservacions')
                    ->join('peliculas', 'peliculas.id','=', 'reservacions.idMovie')
                    ->select('reservacions.idMovie', 'peliculas.name','reservacions.buyP','reservacions.state','reservacions.finish')
                    ->where('reservacions.idUser','=',$id)
                    ->get();
       
        return view('usuario.perfil', compact('usuario','likes','compras','reservacion'));
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
        session()->put('alert', "success");
        session()->put('estado', "¡ Usuario Editado con exito !");
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
            session()->put('alert', "danger");
            session()->put('estado', "¡ Usuario Eliminado con exito !");
        return redirect()->route('Usuario.index');
    }

    public function existeUsuario($id){
        $usuario = Usuario::where('id','=',$id)->first();
        if(empty($usuario)){//USUSARIO NO ENCONTRADO
            session()->put('alert', "danger");
            session()->put('estado', "El usuario #".$id." no existe!");
            return redirect()->route('Usuario.index');
        }
        return $usuario;
    }
}
