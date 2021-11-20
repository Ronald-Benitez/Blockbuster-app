@extends('theme.base')
@section('content')

    <div class="d-flex justify-content-center mt-4">

        <div class="card text-center">
            <div class="card-header h4">
                Entrega de película con retraso
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $alquiler->name }}</h5>
                <p class="card-text p-3">Se aplicara un cargo de 1% sobre el precio original de la renta por cada día de
                    retraso</p>
                <p class="card-text"><b>Precio de alquiler: </b>{{ $alquiler->buyP }}</p>
                <p class="card-text"><b>Días de retraso: </b>{{ $retraso }}</p>
                <p class="card-text"><b>Monto de recargo: </b>{{ $alquiler->buyP * 0.1 * $retraso }}</p>
                <div class="card-footer text-muted">
                    <form action="{{ route('Reservacion.destroy', $alquiler->id) }}" class="my-2 d-flex" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-success flex-fill">
                            <small>Aceptar</small>
                        </button>
                    </form>
                    <a href="{{ route('Pelicula.show', session()->get('idMovie')) }}"
                        class="btn btn-outline-success d-block my-2">Cancelar</a>
                </div>
            </div>


        </div>
    @endsection
