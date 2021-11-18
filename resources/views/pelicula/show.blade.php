@extends('theme.base')
@section('content')
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['idMovie'] = $pelicula->id;
    ?>
    <style>
        .invisible {
            width: 0px;
            height: 0px;
            padding: 0;
            margin: 0;
        }

        .card {
            overflow: hidden;
        }

        @media (max-width:800px) {
            .card {
                width: 99%;
            }

            .img {
                width: 99%;
            }
        }

    </style>
    <div class="d-flex justify-content-center mt-4 pt-4">
        <div class="card" style="width: 45rem;">
            <img src="{{ asset($pelicula->img) }}" class="rounded mx-auto d-block img">
            <div class="card-body text-center">
                <h3 class="card-title">{{ $pelicula->name }}</h3>
                <p class="card-text"><b>Sinopsis</b></p>
                <p class="card-text">
                    {{ $pelicula->synopsis }}
                </p>


                <p class="card-text"><small class="text-muted">Última actualización
                        {{ $pelicula->updated_at }}</small></p>

                @if (isset($_SESSION['idUser']))
                    @if (isset($like))
                        <form action="{{ route('Like.destroy', $like->id) }}" class="my-2" method="post">
                            @method("delete")
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                <small>{{ $pelicula->likes }}</small>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('Like.store') }}" class="my-2" method="post">
                            @csrf
                            <input type="text" class="invisible" name="idM" value="{{ $pelicula->id }}">
                            <button type="submit" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-star" viewBox="0 0 16 16">
                                    <path
                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                </svg>
                                <small>{{ $pelicula->likes }}</small>
                            </button>
                        </form>
                    @endif
                @else
                    <p class="card-text"><small class="text-muted"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path
                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                            </svg>
                            {{ $pelicula->likes }}</small></p>
                @endif


                <div class="input-group">
                    <span class="input-group-text">Precio de alquiler</span>
                    <input type="text" readonly class="form-control" value="${{ $pelicula->reservationP }}">
                    <span class="input-group-text">Precio de compra</span>
                    <input type="text" readonly class="form-control" value="${{ $pelicula->sellP }}" </div>
                </div>


                <a href="{{ route('Pelicula.index') }}" class="btn btn-outline-success d-block my-2">Regresar</a>
            </div>
        </div>
    </div>

@endsection
