<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->exists("typeUser") && session()->get("typeUser") == "admin") {
            $reservaciones = \DB::table('reservacions')
                ->join('usuarios', 'usuarios.id', '=', 'reservacions.idUser')
                ->select('reservacions.begin', 'reservacions.finish', 'reservacions.name', 'usuarios.username', 'reservacions.buyP', 'reservacions.state')
                ->orderBy('reservacions.id', 'desc')
                ->get();
            return view('reservacion.index')->with('reservaciones', $reservaciones);
        }
        return redirect()->route('Pelicula.index');
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
        if (session()->exists("idUser")) {
            $movieData = \DB::table('peliculas')
                ->where('id', $request->input('idM'))
                ->get();
            // echo "<pre>";
            // var_dump($movieData[0]);
            // echo "</pre>";
            if ($movieData[0]->stock > 0) {
                Reservacion::create([
                    "idUser" => session()->get('idUser'),
                    "idMovie" => $request->input("idM"),
                    "state" => "1",
                    "begin" => Carbon::now(),
                    "finish" => Carbon::now()->addMonth(),
                    "buyP" => $movieData[0]->reservationP,
                    "name" => $movieData[0]->name
                ]);
                $movie = Pelicula::where('id', $request->input("idM"));
                $movie->update(["stock" => $movieData[0]->stock - 1]);
                session([
                    'estado' => 'Película rentada con éxito',
                    'alert' => 'success'
                ]);
            } else {
                // echo "<pre>";
                // var_dump($si);
                // echo "</pre>";

                session([
                    'estado' => 'Película sin stock',
                    'alert' => 'warning'
                ]);
            }
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function show($reservacion)
    {
        if (session()->exists("idUser")) {
            $alquiler = \DB::table('reservacions')
                ->where('id', '=', $reservacion)
                ->first();
            // echo "<pre>";
            // var_dump($likes[0]);
            // echo "</pre>";
            $fecha = Carbon::now();
            if (isset($alquiler->finish)) {
                $fecha2 = Carbon::createFromDate($alquiler->finish);
                $retraso = $fecha2->diffInDays($fecha);
                if ($fecha2->lessThan($fecha) && $retraso > 0) {
                    return view('reservacion.show')->with('alquiler', $alquiler)->with('retraso', $retraso);
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservacion $reservacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservacion $reservacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($reservacion)
    {
        $movieData = \DB::table('peliculas')
            ->where('id', session()->get('idMovie'))
            ->get();
        $movie = Pelicula::where('id', session()->get('idMovie'));
        $movie->update(["stock" => $movieData[0]->stock + 1]);

        $reser = Reservacion::where('id', $reservacion);
        $reser->update(["state" => 2]);
        session([
            'estado' => 'Película entregada con éxito',
            'alert' => 'success'
        ]);
        return redirect()->route('Pelicula.show', session()->get('idMovie'));
    }
}
