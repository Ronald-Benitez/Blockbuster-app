<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use DB;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $movieData = \DB::table('peliculas')
            ->where('id', $request->input('idM'))
            ->get();
        $movie = Pelicula::where('id', $request->input("idM"));
        $movie->update(["likes" => $movieData[0]->likes + 1]);

        $si = Like::create([
            "idUser" => $_SESSION['idUser'],
            "idMovie" => $request->input("idM")
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy($like)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $movieData = \DB::table('peliculas')
            ->where('id', $_SESSION['idMovie'])
            ->get();
        $movie = Pelicula::where('id', $_SESSION['idMovie']);
        $movie->update(["likes" => $movieData[0]->likes - 1]);

        DB::table('likes')
            ->where('id', $like)
            ->delete();
        return redirect()->back();
    }
}
