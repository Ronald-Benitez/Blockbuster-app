@extends('theme.base')

@section('content')
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

        @media (max-width:450px) {
            .card {
                width: 100%;
            }

            .imgX {
                max-height: 300px;

            }
        }

    </style>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        session([
            'typeUser' => 'user',
            'idUser' => '4',
        ]);
        // unset($_SESSION['typeUser']);
        // unset($_SESSION['idUser']);
    }
    
    $count = 0;
    ?>
    <div class="container py-5">
        <h1 class="text-center">Working in progress</h1>

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
    </div>
    <div class="container">
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
                        <div class="d-flex justify-content-around">

                            <a class="btn btn-warning" style="cursor: default;"><b>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-star" viewBox="0 0 16 16">
                                        <path
                                            d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                    </svg>
                                    <small class="text-dark">{{ $pelicula->likes }}</small>
                                </b>
                            </a>


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
@section('script')
    <script>
        $(function() {
            setTimeout(() => {
                $(".alert").remove();
            }, 4000);

        });
    </script>

@endsection
