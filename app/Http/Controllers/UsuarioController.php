<?php
//CONTROLADORES DEL USUARIO
namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Reservacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\UseUse;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Carbon;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //PERMISOS, SOLO ADMIN
    {
        if (session()->exists('typeUser')) {
            if (session()->get('typeUser') != "admin") {
                session()->put('alert', "danger");
                session()->put('estado', "¡¡ Acceso Denegado!!");
                return redirect()->back();
            }
        } else {
            session()->put('alert', "danger");
            session()->put('estado', "¡¡ Session no iniciada !!");
            return redirect()->back();
        }
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
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
        $flag = false;
        $request->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required'
        ]);
        $usuario = new Usuario();
        $usuario->username = $request->username;
        $usuario->password = password_hash($request->password, PASSWORD_DEFAULT);
        $usuario->type = "user";
        if (!empty($request->type)) {
            $flag = true;
            $usuario->type = $request->type;
        }

        //Si ya existe el usuario
        $user = Usuario::where('username', '=', $request->username)->first();
        if (!empty($user)) {
            session()->put('alert', "danger");
            session()->put('estado', "El usuario " . $request->username . " ya existe!");
            return redirect()->route('Usuario.create');
        }
        $usuario->save();
        //mensaje de Exito
        session()->put('alert', "success");
        session()->put('estado', "¡ Usuario Agregado con exito !");
        if ($flag) {
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
        //Verificacion de Sesiones
        if (session()->exists('typeUser')) {
            if ($id != session()->get('idUser')) {
                session()->put('alert', "danger");
                session()->put('estado', "¡¡ No se puede acceder a la privacidad del ususario !!");
                return redirect()->back();
            }
        } else {
            session()->put('alert', "danger");
            session()->put('estado', "¡¡ Session no iniciada !!");
            return redirect()->back();
        }

        $usuario = Usuario::where('id', '=', $id)->first();
        if (empty($usuario)) { //USUARIO NO ENCONTRADO

            return redirect()->route('Usuario.index');
        }
        //LLAMADO DE LAS SIGUIENTES TABLAS
        //LIKES
        $likes = DB::table('likes')
            ->join('peliculas', 'peliculas.id', '=', 'likes.idMovie')
            ->select('peliculas.id', 'peliculas.name',)
            ->where('likes.idUser', $id)
            ->get();
        //COMPRAS DE PELICULAS
        $compras = DB::table('compras')
            ->select('idMovie', 'created_at', 'name', 'buyP', 'id')
            ->where('compras.idUser', '=', $id)
            ->orderBy('id', 'asc')
            ->get();

        //Reservaciones de peliculas
        $reservacion = DB::table('reservacions')
            ->join('peliculas', 'peliculas.id', '=', 'reservacions.idMovie')
            ->select('reservacions.idMovie', 'peliculas.name', 'reservacions.buyP', 'reservacions.state', 'reservacions.finish', 'reservacions.id')
            ->where('reservacions.idUser', '=', $id)
            ->get();
        $now = Carbon::now();
        return view('usuario.perfil', compact('usuario', 'likes', 'compras', 'reservacion', 'now'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //PERMISO DE USUARIO, SOLO ADMIN
        if (session()->exists('typeUser')) {
            if (session()->get('typeUser') != "admin" && (session()->get('idUser') != $id)) {
                session()->put('alert', "danger");
                session()->put('estado', "¡¡ Acceso Denegado!!");
                return redirect()->back();
            }
        } else {
            session()->put('alert', "danger");
            session()->put('estado', "¡¡ Session no iniciada !!");
            return redirect()->back();
        }
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
            'username' => 'required|alpha_dash',
            'password' => 'required_with:cambiar',
        ]);

        $type = "user";

        if (isset($request->type)) {
            $type = $request->type;
        }

        $usuario = $this->existeUsuario($id);

        if (isset($request->password)) {
            $data = ([
                'username' => $request->username,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'type' => $type
            ]);
        } else {
            $data = ([
                'username' => $request->username,
                'type' => $type
            ]);
        }

        $usuario->update($data);

        if ($id == session()->get('idUser')) {
            session()->put('username', $request->username);
        }

        session()->put('alert', "success");
        session()->put('estado', "¡ Usuario " . $usuario->username . " Editado con exito !");

        if ($id == session()->get('idUser') && $type != 'admin' && session()->get('typeUser') == 'admin') {
            session()->put('typeUser', $request->type);
            session()->put('username', $request->username);
            session()->put('estado', "¡ Administracion de" . $usuario->username . " revocada con exito !");
            return redirect()->route('Pelicula.index');
        }
        if (session()->get("typeUser") == "admin") {
            return redirect()->route('Usuario.index');
        }
        return redirect()->route('Usuario.show', session()->get("idUser"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //ELIMINACION DE USUARIO
    {
        $usuario = $this->existeUsuario($id);
        $usuario->delete();
        session()->put('alert', "danger");
        session()->put('estado', "¡ Usuario Eliminado con exito !");
        return redirect()->route('Usuario.index');
    }

    private function existeUsuario($id) //USUARIOS EXISTENTES
    {
        $usuario = Usuario::where('id', '=', $id)->first();
        if (empty($usuario)) { //USUSARIO NO ENCONTRADO
            session()->put('alert', "danger");
            session()->put('estado', "El usuario #" . $id . " no existe!");
            return redirect()->route('Usuario.index');
        }
        return $usuario;
    }
}
