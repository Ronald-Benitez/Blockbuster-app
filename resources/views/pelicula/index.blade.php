@extends('theme.base')

@section('css')
    <style>
        .btn-config:hover {
            border: 1px solid #346751;
        }

        .card {
            width: 20%;
            display: flex;
            justify-content: center;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .imgX {
            max-height: 150px;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img {
            overflow: inherit;
        }

        @media (max-width:1200px) {
            .card {
                width: 32%;
            }
        }

        @media (max-width:800px) {
            .card {
                width: 48%;
            }
        }

        @media (max-width:500px) {
            .card {
                width: 98%;
            }

            .imgX {
                max-height: 300px;

            }
        }

    </style>
@endsection

@section('content')

    <div class="container my-5 p-4">
        @include("theme.alert")
        <div class="row d-flex justify-content-around">
            @foreach ($peliculas as $pelicula)

                <div class="card text-center">

                    <a href="{{ route('Pelicula.show', $pelicula->id) }}" class="btn btn-config mt-2 imgX">
                        <img loading="lazy" src="{{ asset($pelicula->img) }}" class="img-fluid img " alt="...">
                    </a>
                    <div class="card-body">
                        <a href="{{ route('Pelicula.show', $pelicula->id) }}" class="btn btn-config">
                            <h5 class=" card-title">{{ $pelicula->name }}</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">Última actualización
                                {{ $pelicula->updated_at }}</small></p>
                        <div class="d-flex justify-content-around align-items-center">

                            @if (session()->exists('idUser') && session()->get('typeUser') == 'admin')
                                <a href="{{ route('Pelicula.edit', $pelicula->id) }}" class="btn btn-warning">
                                    <b>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pen" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                        </svg>
                                    </b>
                                </a>
                            @endif

                            <b class="text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                                </svg>
                                <small class="text-dark">{{ $pelicula->likes }}</small>
                            </b>

                            @if (session()->exists('idUser') && session()->get('typeUser') == 'admin')
                                <form action="{{ route('Pelicula.destroy', ['Pelicula' => $pelicula->id]) }}"
                                    method="post" class="d-inline">
                                    @method("delete")
                                    @csrf
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Seguro que desea eliminar?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </button>
                                </form>

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

@section('footer')
    @if (isset($aux))
        @include('theme.footer-index')
    @else
        @include('theme.footer-home')
    @endif
@endsection
