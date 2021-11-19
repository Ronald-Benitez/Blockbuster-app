<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class help
{
    public $name;
    public $synopsis;
    public $sellP;
    public $reservationP;
    public $stock;
}

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
        return view('pelicula.form')->with("data", new help);
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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

        session_start();

        $movie = \DB::table('peliculas')
            ->where('id', '=', $pelicula)
            ->get();

        if (isset($_SESSION['idUser'])) {
            $likes = \DB::table('likes')
                ->select('id')
                ->where('idUser', '=', $_SESSION['idUser'])
                ->where('idMovie', '=', $pelicula)
                ->first();

            $compra = \DB::table('compras')
                ->select('id')
                ->where('idUser', '=', $_SESSION['idUser'])
                ->where('idMovie', '=', $pelicula)
                ->first();

            $alquiler = \DB::table('reservacions')
                ->select('id')
                ->where('idUser', '=', $_SESSION['idUser'])
                ->where('idMovie', '=', $pelicula)
                ->first();
            // echo "<pre>";
            // var_dump($likes[0]);
            // echo "</pre>";

            return view('pelicula.show')
                ->with('pelicula', $movie[0])
                ->with("like", $likes)
                ->with("compra", $compra)
                ->with("alquiler", $alquiler);
        }

        return view('pelicula.show')->with('pelicula', $movie[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelicula = Pelicula::where('id', $id)->first();
        // echo "<pre>";
        // var_dump($movie[0]);
        // echo "</pre>";
        return view('pelicula.form', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pelicula)
    {
        $request->validate([
            'synopsis' => 'required',
            'name' => 'required',
            'sellP' => 'required|min:0',
            'reservationP' => 'required|min:0',
            'stock' => 'required|min:0'
        ]);
        if (!empty($request->file('file'))) {
            $img = $request->file('file')->store('public/img');
            $urlImg = Storage::url($img);

            $data = ([
                "name" => $request->input('name'),
                "synopsis" => $request->input('synopsis'),
                "img" => $urlImg,
                "stock" => $request->input('stock'),
                "sellP" => $request->input('sellP'),
                "reservationP" => $request->input('reservationP')
            ]);
        } else {
            $data = ([
                "name" => $request->input('name'),
                "synopsis" => $request->input('synopsis'),
                "stock" => $request->input('stock'),
                "sellP" => $request->input('sellP'),
                "reservationP" => $request->input('reservationP')
            ]);
        }
        $toUpdate = Pelicula::where('id', $pelicula);
        $toUpdate->update($data);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["estado"] = "Película actualizada con éxito";
        $_SESSION["alert"] = "success";
        return redirect()->route('Pelicula.show', $pelicula);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($pelicula)
    {
        DB::table('peliculas')
            ->where('id', $pelicula)
            ->delete();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["estado"] = "Eliminado éxitoso";
        $_SESSION["alert"] = "danger";
        return redirect()->route('Pelicula.index');
    }
}
