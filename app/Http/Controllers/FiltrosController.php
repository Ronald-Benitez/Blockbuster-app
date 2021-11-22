<?php//controladores para fitros

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiltrosController extends Controller
{
    public function index()
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $pelicula = \DB::table('peliculas')
                ->get();


            return view('pelicula.index-compact')->with('peliculas', $pelicula);
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
        return redirect()->back();
    }

    public function byPopulares()//filtro por popularidad
    {
        $pelicula = \DB::table('peliculas')
            ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
            ->where('stock', '>', 0)
            ->orderBy('likes', 'desc')
            ->get();

        return view('pelicula.index')->with('peliculas', $pelicula);
    }

    public function byNombre()//fitro por nombre
    {
        $pelicula = \DB::table('peliculas')
            ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
            ->where('stock', '>', 0)
            ->orderBy('name', 'asc')
            ->get();

        return view('pelicula.index')->with('peliculas', $pelicula);
    }

    public function disponibles()//Filtro por disponiblidad
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $pelicula = \DB::table('peliculas')
                ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
                ->where('stock', '>', 0)
                ->orderBy('name', 'asc')
                ->get();

            if (!empty($pelicula[0])) {
                return view('pelicula.index')->with('peliculas', $pelicula);
            } else {
                session([
                    'estado' => 'No hay películas disponibles',
                    'alert' => 'warning'
                ]);
            }
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
        return redirect()->back();
    }

    public function sinStock()//pelicula sin disponiblidad
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $pelicula = \DB::table('peliculas')
                ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
                ->where('stock', '<', 1)
                ->orderBy('name', 'asc')
                ->get();

            if (!empty($pelicula[0])) {
                return view('pelicula.index')->with('peliculas', $pelicula);
            } else {
                session([
                    'estado' => 'No hay películas sin stock',
                    'alert' => 'warning'
                ]);
            }
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
        return redirect()->back();
    }

    public function likeThis(Request $request)//opcion de me gusta
    {
        $request->validate([
            'search' => 'required'
        ]);

        $pelicula = \DB::table('peliculas')
            ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
            ->where('name', 'LIKE', '%' . $request->input('search') . '%')
            ->get();

        $aux = 0;
        if (!empty($pelicula[0])) {
            return view('pelicula.index')->with('peliculas', $pelicula)->with('aux', $aux);
        } else {
            session([
                'estado' => 'Pelicula no encontrada',
                'alert' => 'warning'
            ]);
            return redirect()->route('Pelicula.index');
        }
    }
}
