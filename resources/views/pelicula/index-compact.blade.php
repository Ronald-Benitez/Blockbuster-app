@extends('theme.base')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

    <div class="card my-5" style="width:99%">
        <div class="card-title text-center my-4">
            <h3>Registro de peliculas</h3>
        </div>
        <div class="card-body">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    @if (session()->exists('estado'))
                        <div class="alert alert-{{ session()->get('alert') }}" role="alert">
                            {{ session()->get('estado') }}
                        </div>
                    @endif

                    <?php
                    if (session()->exists('estado')) {
                        session()->forget('estado');
                        session()->forget('alert');
                    }
                    ?>

                    <table class="table table-striped" id="buy" width="99%">
                        <thead>
                            <tr>
                                <th scope="col" class="align-middle">Id</th>
                                <th scope="col" class="align-middle">Película</th>
                                <th scope="col" class="align-middle">Última actualización</th>
                                <th scope="col" class="align-middle">Likes</th>
                                <th scope="col" class="align-middle">Stock</th>
                                <th scope="col" class="align-middle">Precio de venta</th>
                                <th scope="col" class="align-middle">Precio de alquiler</th>
                                <th scope="col" class="align-middle">Acciones</th>
                            </tr>
                        </thead>
                        @foreach ($peliculas as $pelicula)
                            <tr class="text-center">
                                <td>{{ $pelicula->id }}</td>
                                <td>{{ $pelicula->name }}</td>
                                <td>{{ $pelicula->updated_at }}</td>
                                <td>{{ $pelicula->likes }}</td>
                                <td>{{ $pelicula->stock }}</td>
                                <td>{{ $pelicula->sellP }}</td>
                                <td>{{ $pelicula->reservationP }}</td>
                                <td>
                                    <a href="{{ route('Pelicula.edit', $pelicula->id) }}" class="btn btn-warning">
                                        <b>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                            </svg>
                                        </b>
                                    </a>
                                    <form action="{{ route('Pelicula.destroy', ['Pelicula' => $pelicula->id]) }}"
                                        method="post" class="d-inline">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Seguro que desea eliminar?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
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
            $('#buy').DataTable({
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
