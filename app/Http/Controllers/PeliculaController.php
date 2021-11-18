<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelicula = \DB::table('peliculas')
            ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes')
            ->where('stock', '>', 0)
            ->get();
        return view('pelicula.index')->with('peliculas', $pelicula);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelicula.form');
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
            'file' => 'required|image|max:2048',
            'synopsis' => 'required',
            'name' => 'required',
            'sellP' => 'required|min:0',
            'reservationP' => 'required|min:0',
            'stock' => 'required|min:0'
        ]);
        $img = $request->file('file')->store('public/img');
        $urlImg = Storage::url($img);

        $data = ([
            "name" => $request->input('name'),
            "synopsis" => $request->input('synopsis'),
            "img" => $urlImg,
            "likes" => 0,
            "stock" => $request->input('stock'),
            "sellP" => $request->input('sellP'),
            "reservationP" => $request->input('reservationP')
        ]);

        Pelicula::create($data);
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        session_start();
        $_SESSION["estado"] = "Película registrada con éxito";
        $_SESSION["alert"] = "success";
        return redirect()->route('Pelicula.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show($pelicula)
    {
        $pelicula = \DB::table('peliculas')
            ->where('id', '=', $pelicula)
            ->get();
        // echo "<pre>";
        // var_dump($pelicula[0]->name);
        // echo "</pre>";
        return view('pelicula.show')->with('pelicula', $pelicula[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelicula $pelicula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelicula $pelicula)
    {
        //
    }
}
