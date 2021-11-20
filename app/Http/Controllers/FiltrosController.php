<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiltrosController extends Controller
{
    public function index()
    {
        $pelicula = \DB::table('peliculas')
            ->get();

        return view('pelicula.index-compact')->with('peliculas', $pelicula);
    }

    public function disponibles()
    {
        $pelicula = \DB::table('peliculas')
            ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
            ->where('stock', '>', 0)
            ->get();

        return view('pelicula.index')->with('peliculas', $pelicula);
    }

    public function sinStock()
    {
        $pelicula = \DB::table('peliculas')
            ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
            ->where('stock', '<', 1)
            ->get();

        return view('pelicula.index')->with('peliculas', $pelicula);
    }
}
