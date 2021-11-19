@extends('theme.base')

@section('content')

    <div class="h2 text-center my-4">Registro de compras</div>

    <div class="container ">
        <div class="row d-flex justify-content-center">
            <table class="table table-striped w-75">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle">Fecha</th>
                        <th scope="col" class="align-middle">Película</th>
                        <th scope="col" class="align-middle">Precio</th>
                        <th scope="col" class="align-middle">Usuario</th>
                    </tr>
                </thead>
                @foreach ($compras as $compra)
                    <tr>
                        <td>{{ $compra->created_at }}</td>
                        <td>{{ $compra->name }}</td>
                        <td>{{ $compra->buyP }}</td>
                        <td>{{ $compra->username }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="row d-flex justify-content-center">
            <a href="{{ route('Pelicula.index') }}" class="btn btn-outline-success d-block my-2 w-50">Inicio</a>
        </div>
    </div>

@endsection
