@extends('theme.base')

@section('content')
    <style>
        .card {
            width: 18%
        }

        @media (max-width:1000px) {
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
                width: 99%;
            }
        }

    </style>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        $_SESSION['typeUser'] = 'admin';
        $_SESSION['idUser'] = 1;
    }
    
    $count = 0;
    ?>
    <div class="container py-5">
        <h1 class="text-center">Working in progress</h1>

        @if (isset($_SESSION['estado']))
            <div class="alert alert-{{ $_SESSION['alert'] }}" role="alert">
                {{ $_SESSION['estado'] }}
            </div>
        @endif

        <?php
        if (isset($_SESSION['estado'])) {
            unset($_SESSION['estado']);
            unset($_SESSION['alert']);
        }
        ?>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach ($peliculas as $pelicula)

                <div class="card text-center m-1">

                    <a href="{{ route('Pelicula.show', $pelicula->id) }}" class="btn btn-outline-secondary mt-2">
                        <img src="{{ asset($pelicula->img) }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body ">
                        <a href="{{ route('Pelicula.show', $pelicula->id) }}" class="btn btn-light">
                            <h5 class=" card-title">{{ $pelicula->name }}</h5>
                        </a>
                        <p class="card-text"><small class="text-muted">Última actualización
                                {{ $pelicula->updated_at }}</small></p>
                        <div class="d-flex justify-content-around">

                            <a class="btn btn-warning"><b>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-star" viewBox="0 0 16 16">
                                        <path
                                            d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                    </svg>
                                    <small class="text-dark">{{ $pelicula->likes }}</small>
                                </b></a>


                            @if (isset($_SESSION['typeUser']) && $_SESSION['typeUser'] == 'admin')
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
