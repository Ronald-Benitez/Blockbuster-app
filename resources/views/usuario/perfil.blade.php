@extends('theme.base')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
    @php
    use Illuminate\Support\Carbon;
    @endphp
    <div class="container my-5 py-4">
        @include("theme.alert")

        <div class="card">
            <div class="card-head d-flex justify-content-center">
                <div class="container  d-flex mt-3">
                    <p class="h3 ms-4 col-md-5 col-4 col-sm-5 col-lg-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                          </svg>
                        {{ session()->get('username') }}
                    </p>
                    
                    <a href="{{route('Usuario.edit',session()->get('idUser'))}}" class="btn col-sm-5 col-4 col-md-5 col-lg-3 btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                          </svg>
                          Editar Perfil</a>
                </div>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Me gustan
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{-- Cuerpo Likes --}}

                                @if (empty($likes[0]))
                                    <div class="bg-warning p-2 mt-3 border border-1 border-dark rounded-3 text-center">
                                        <p>
                                            El ususario no ha dado 'Megusta' a ninguna Pelicula
                                        </p>
                                    </div>
                                @else
                                    <table class="table table-responsive table-hover table-stripped" id="Like">
                                        <thead>
                                            <tr class="table-dark">
                                                <td>ID</td>
                                                <td>Nombre de la Pelicula</td>
                                                <td>Acciones</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($likes as $like)
                                                <tr>
                                                    <td>{{ $like->id }}</td>
                                                    <td>{{ $like->name }}</td>
                                                    <td><a href="{{ route('Pelicula.show', $like->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            ver
                                                        </a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif


                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Peliculas Rentadas
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                {{-- Cuerpo Rentadas --}}
                                @if (empty($reservacion[0]))
                                    <div class="bg-warning p-2 mt-3 border border-1 border-dark rounded-3 text-center">
                                        <p>
                                            El ususario no ha Rentado ninguna Pelicula
                                        </p>
                                    </div>
                                @else
                                    <div class="contianer-fluid overflow-auto">
                                        <table class="table table-responsive table-hover table-stripped" id="Renta">
                                            <thead>
                                                <tr class="table-dark">
                                                    <td>ID</td>
                                                    <td>Pelicula</td>
                                                    <td>Alquiler($)</td>
                                                    <td>Estado</td>
                                                    <td>Entregar</td>
                                                    <td>Acciones</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reservacion as $renta)
                                                    <tr>
                                                        @php
                                                            $date = Carbon::createFromDate($renta->finish);
                                                        @endphp
                                                        <td>{{ $renta->id }}</td>
                                                        <td>{{ $renta->name }}</td>
                                                        <td>$ {{ $renta->buyP }}</td>
                                                        <td>
                                                            @if ($renta->state == '1' && $date->lessThan($now))
                                                                <p class="text-danger">
                                                                    Retrasada
                                                                </p>

                                                            @elseif($renta->state == '1')
                                                                <p class="text-warning">
                                                                    Pendiente
                                                                </p>
                                                            @else
                                                                Entregada
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($renta->state == '1' && $date->lessThan($now))
                                                                <p class="text-danger">
                                                                    {{ $renta->finish }}
                                                                </p>

                                                            @elseif($renta->state == '1')
                                                                <p class="text-warning">
                                                                    {{ $renta->finish }}
                                                                </p>
                                                            @else
                                                                {{ $renta->finish }}
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="{{ route('Pelicula.show', $renta->idMovie) }}"
                                                                class="btn btn-success btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-eye"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                    <path
                                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                                </svg>
                                                                ver
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Peliculas Compradas
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                {{-- Cuerpo Compradas --}}

                                @if (empty($compras[0]))
                                    <div class="bg-warning p-2 mt-3 border border-1 border-dark rounded-3 text-center">
                                        <p>
                                            El ususario no ha Comprado ninguna Pelicula
                                        </p>
                                    </div>
                                @else
                                    <div class="contianer-fluid overflow-auto">
                                        <table class="table table-responsive table-hover table-stripped" id="Venta">
                                            <thead>
                                                <tr class="table-dark">
                                                    <td>ID</td>
                                                    <td>Nombre de la Pelicula</td>
                                                    <td>Precio($)</td>
                                                    <td>Fecha de Compra</td>
                                                    <td>Acciones</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($compras as $compra)
                                                    <tr>
                                                        <td>{{ $compra->id }}</td>
                                                        <td>{{ $compra->name }}</td>
                                                        <td>$ {{ $compra->buyP }}</td>
                                                        <td>{{ $compra->created_at }}</td>
                                                        <td>
                                                            <a href="{{ route('Pelicula.show', $compra->idMovie) }}"
                                                                class="btn btn-success btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-eye"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                    <path
                                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                                </svg>
                                                                ver
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{--  --}}

@endsection

@section('footer')
    @include('theme.footer-index')
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    {{-- Tiempo de vida de la alerta --}}
    <script>
        $(function() {
            setTimeout(() => {
                $(".alert").remove();
            }, 4000);
        });
    </script>
    {{-- Tabla --}}
    <script>
        $(document).ready(function() {
            $('#Like,#Renta,#Venta').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar " +
                        `<select>
                    <option value = "5">5</option>
                    <option value = "10">10</option>
                    <option value = "15">25</option>
                    <option value = "50">50</option>
                    <option value = "-1">All</option>
                    </select>` +
                        " registros por p??gina",
                    "zeroRecords": "Sin resultados",
                    "info": "Mostrando p??gina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin registros",
                    "infoFiltered": "(Filtrando de _MAX_ registros totales)",
                    'search': 'Buscar',
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }

            });
        });
    </script>

@endsection

