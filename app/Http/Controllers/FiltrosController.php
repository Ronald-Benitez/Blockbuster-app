<?php

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

    public function disponibles()
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $pelicula = \DB::table('peliculas')
                ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
                ->where('stock', '>', 0)
                ->get();

            return view('pelicula.index')->with('peliculas', $pelicula);
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
        return redirect()->back();
    }

    public function sinStock()
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $pelicula = \DB::table('peliculas')
                ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
                ->where('stock', '<', 1)
                ->get();

            return view('pelicula.index')->with('peliculas', $pelicula);
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
        return redirect()->back();
    }
}
