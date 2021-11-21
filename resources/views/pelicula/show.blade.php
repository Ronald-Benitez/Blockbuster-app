@extends('theme.base')
@section('content')
    <?php
    session([
        'idMovie' => $pelicula->id,
    ]);
    
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
                overflow: inherit;
            }

        }

    </style>
    <div class="container text-center mt-5">
        <h1 class="text-center mt-5 pt-4">{{ $pelicula->name }}</h1>
        @include('theme.alert')
        @if (isset($alquiler) && !empty($alquiler) && $alquiler->state == 1)
            @if ($retraso > 0)
                <small class="text-danger m-2">Pelicula rentada</small><br>
                <small class="text-danger m-2">Entrega retrasada por {{ $retraso }} días</small><br>
                <small class="text-danger m-2">Fecha de entrega: {{ $alquiler->finish }}</small>
            @else
                <small class="text-success m-2">Pelicula rentada</small><br>
                <small class="text-success m-2">Fecha de entrega: {{ $alquiler->finish }}</small>
            @endif

        @endif

        <?php
        if (session()->exists('estado')) {
            session()->forget('estado');
            session()->forget('alert');
        }
        ?>
    </div>
    <div class="d-flex justify-content-center my-5">

        <div class="card mb-5" style="width: 45rem;">
            <img loading="lazy" src="{{ asset($pelicula->img) }}" class="img-fluid img">
            <div class="card-body text-center">
                <p class="card-text"><b>Sinopsis</b></p>
                <p class="card-text">
                    {{ $pelicula->synopsis }}
                </p>


                <p class="card-text"><small class="text-muted">Última actualización
                        {{ $pelicula->updated_at }}</small></p>

                <br>
                @include("pelicula.like-btn")
                <br>
                @include("pelicula.admin-btn")
                <div class="row mt-4">
                    <div class="col-6 d-flex">
                        <span class="border border-dark rounded-pill flex-fill">Compra ${{ $pelicula->sellP }}</span>

                    </div>
                    <div class="col-6 d-flex">
                        <span class="border border-dark rounded-pill flex-fill">Alquiler
                            ${{ $pelicula->reservationP }}</span>

                    </div>

                </div>

                @include("pelicula.sell-reser")
            </div>
        </div>

    </div>

@endsection

@section('footer')
    @include('theme.footer-index')
@endsection
