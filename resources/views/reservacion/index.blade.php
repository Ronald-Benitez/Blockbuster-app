@extends('theme.base')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <style>
        /* footer {
                                        position: sticky;
                                        z-index: 1;
                                        bottom: 0;
                                    } */

    </style>
@endsection

@section('content')
    <div class="card my-5" style="width:99%">
        <div class="card-title text-center my-4">
            <h3>Registro de alquileres</h3>
        </div>
        <div class="card-body">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    <table class="table table-striped" id="reser">
                        <thead>
                            <tr>
                                <th scope="col" class="align-middle">Id</th>
                                <th scope="col" class="align-middle">Pelicula</th>
                                <th scope="col" class="align-middle">Usuario</th>
                                <th scope="col" class="align-middle">Fecha de alquiler</th>
                                <th scope="col" class="align-middle">Fecha de entrega</th>
                                <th scope="col" class="align-middle">Precio</th>
                                <th scope="col" class="align-middle">Estado</th>
                            </tr>
                        </thead>
                        @foreach ($reservaciones as $reservacion)
                            <tr>
                                <td>{{ $reservacion->id }}</td>
                                <td>{{ $reservacion->name }}</td>
                                <td>{{ $reservacion->username }}</td>
                                <td>{{ $reservacion->begin }}</td>
                                <td>{{ $reservacion->finish }}</td>
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

            </div>

        </div>
    </div>


@endsection

@section('footer')
    @include('theme.footer-index')
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#reser').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar" +
                        `<select>
                        <option value = "5">5</option>
                        <option value = "10">10</option>
                        <option value = "15">25</option>
                        <option value = "50">50</option>
                        <option value = "-1">All</option>

                        </select>` +
                        "registros por página",
                    "zeroRecords": "Sin resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin registros",
                    "infoFiltered": "(Filtrando de _MAX_ registros totales)",
                    "search": "Buscar",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
@endsection
