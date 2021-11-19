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
    <div class="container py-5">
        <h1 class="text-center mt-4">{{ $pelicula->name }}</h1>
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
    <div class="d-flex justify-content-center ">


        <div class="card" style="width: 45rem;">
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

                <a href="{{ route('Pelicula.index') }}" class="btn btn-outline-success d-block my-2">Regresar</a>
            </div>
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
