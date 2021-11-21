<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

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
            ->select('id', 'updated_at', 'name', 'synopsis', 'img', 'likes', 'stock')
            ->where('stock', '>', 0)
            ->orderBy('name', 'asc')
            ->get();
        if (empty($pelicula[0])) {
            session([
                'estado' => 'No hay películas disponibles',
                'alert' => 'warning'
            ]);
        }

        return view('pelicula.index')->with('peliculas', $pelicula);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            return view('pelicula.form')->with("data", new help);
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
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
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $request->validate([
                'file' => 'required|image',
                'synopsis' => 'required',
                'name' => 'required',
                'sellP' => 'required|numeric|min:0',
                'reservationP' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0'
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
            session([
                'estado' => 'Película guardada con éxito',
                'alert' => 'success'
            ]);
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
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
        $movie = \DB::table('peliculas')
            ->where('id', '=', $pelicula)
            ->get();

        if (!empty($movie[0])) {

            if (session()->exists('idUser')) {
                $fecha = Carbon::now();

                $likes = \DB::table('likes')
                    ->select('id')
                    ->where('idUser', '=', session()->get('idUser'))
                    ->where('idMovie', '=', $pelicula)
                    ->first();

                $compra = \DB::table('compras')
                    ->select('id')
                    ->where('idUser', '=', session()->get('idUser'))
                    ->where('idMovie', '=', $pelicula)
                    ->first();

                $alquiler = \DB::table('reservacions')
                    ->select('id', 'finish', "state")
                    ->where('idUser', '=', session()->get('idUser'))
                    ->where('idMovie', '=', $pelicula)
                    ->orderBy('id', "desc")
                    ->first();
                // echo "<pre>";
                // var_dump($likes[0]);
                // echo "</pre>";
                $retraso = 0;
                if (isset($alquiler->finish)) {
                    $fecha2 = Carbon::createFromDate($alquiler->finish);
                    if ($fecha2->lessThan($fecha)) {
                        $retraso = $fecha2->diffInDays($fecha);
                    }
                }
                return view('pelicula.show')
                    ->with('pelicula', $movie[0])
                    ->with("like", $likes)
                    ->with("compra", $compra)
                    ->with("alquiler", $alquiler)
                    ->with("retraso", $retraso);
            }
        } else {
            session([
                'estado' => 'La pelicula no existe o ha sido eliminada',
                'alert' => 'warning'
            ]);
            return redirect()->route('Pelicula.index');
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
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $pelicula = Pelicula::where('id', $id)->first();
            // echo "<pre>";
            // var_dump($movie[0]);
            // echo "</pre>";
            return view('pelicula.form', compact('pelicula'));
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
        return redirect()->back();
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
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $request->validate([
                'synopsis' => 'required',
                'name' => 'required',
                'sellP' => 'required|min:0',
                'reservationP' => 'required|min:0',
                'stock' => 'required|min:0'
            ]);
            if (!empty($request->file('file'))) {
                //Borrar imagén
                $movie =  DB::table('peliculas')
                    ->where('id', $pelicula)
                    ->first();
                $url = str_replace("storage", "public", $movie->img);
                Storage::delete($url);

                //Guardar nueva imagén
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
            session([
                'estado' => 'Película actualizada con éxito',
                'alert' => 'success'
            ]);
            return redirect()->route('Pelicula.show', $pelicula);
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($pelicula)
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $movie =  DB::table('peliculas')
                ->where('id', $pelicula)
                ->first();
            $url = str_replace("storage", "public", $movie->img);
            Storage::delete($url);

            DB::table('peliculas')
                ->where('id', $pelicula)
                ->delete();

            session([
                'estado' => 'Película eliminada con éxito',
                'alert' => 'danger'
            ]);
        } else {
            session([
                'estado' => 'Acceso denegado',
                'alert' => 'danger'
            ]);
        }

        return redirect()->route('Pelicula.index');
    }
}
