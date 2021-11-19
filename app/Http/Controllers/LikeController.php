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
        return redirect()->back();
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
        if (session()->exists("idUser")) {
            $movieData = \DB::table('peliculas')
                ->where('id', $request->input('idM'))
                ->get();
            $movie = Pelicula::where('id', $request->input("idM"));
            $movie->update(["likes" => $movieData[0]->likes + 1]);

            $si = Like::create([
                "idUser" => session()->get('idUser'),
                "idMovie" => $request->input("idM")
            ]);
        }
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
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        return redirect()->back();
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
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy($like)
    {
        $movieData = \DB::table('peliculas')
            ->where('id', session()->get('idMovie'))
            ->get();
        $movie = Pelicula::where('id', session()->get('idMovie'));
        $movie->update(["likes" => $movieData[0]->likes - 1]);

        DB::table('likes')
            ->where('id', $like)
            ->delete();
        return redirect()->back();
    }
}
