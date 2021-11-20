@extends('theme.base')

@section('content')

    <div class="h2 text-center my-4">Registro de alquileres</div>

    <div class="container ">
        <div class="row d-flex justify-content-center">
            <table class="table table-striped w-75">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle">Fecha de alquiler</th>
                        <th scope="col" class="align-middle">Fecha de entrega</th>
                        <th scope="col" class="align-middle">Pelicula</th>
                        <th scope="col" class="align-middle">Usuario</th>
                        <th scope="col" class="align-middle">Precio</th>
                        <th scope="col" class="align-middle">Estado</th>
                    </tr>
                </thead>
                @foreach ($reservaciones as $reservacion)
                    <tr>
                        <td>{{ $reservacion->begin }}</td>
                        <td>{{ $reservacion->finish }}</td>
                        <td>{{ $reservacion->name }}</td>
                        <td>{{ $reservacion->username }}</td>
                        <td>{{ $reservacion->buyP }}</td>
                        @if ($reservacion->state == 1)
                            <td>Activa</td>
                        @else
                            <td>Entregada</td>
                        @endif

                    </tr>
                @endforeach
            </table>

        </div>
        <div class="row d-flex justify-content-center">
            <a href="{{ route('Pelicula.index') }}" class="btn btn-outline-success d-block my-2 w-50">Inicio</a>
        </div>
    </div>

@endsection
