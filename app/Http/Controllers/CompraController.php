<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = \DB::table('compras')
            ->get('compras');
        return view('compra.index')->with('compras', $compras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['idUser'])) {
            $movieData = \DB::table('peliculas')
                ->where('id', $request->input('idM'))
                ->get();
            // echo "<pre>";
            // var_dump($movieData[0]);
            // echo "</pre>";
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if ($movieData[0]->stock > 0) {
                Compra::create([
                    "name" => $movieData[0]->name,
                    "buyP" => $movieData[0]->sellP,
                    "idUser" => $_SESSION['idUser'],
                    "idMovie" => $request->input("idM")
                ]);
                $movie = Pelicula::where('id', $request->input("idM"));
                $movie->update(["stock" => $movieData[0]->stock - 1]);
                $_SESSION["estado"] = "Película comprada con éxito";
                $_SESSION["alert"] = "success";
            }
            // echo "<pre>";
            // var_dump($si);
            // echo "</pre>";
            $_SESSION["estado"] = "Película sin stock";
            $_SESSION["alert"] = "warning";
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        return redirect()->back();
    }
}
