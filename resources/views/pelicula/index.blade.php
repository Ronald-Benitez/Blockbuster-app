@extends('theme.base')

@section('content')
    <?php
    session_start();
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
        <div class="container">
            <div class="row">
                @foreach ($peliculas as $pelicula)

                    <div class="card col-3">
                        <img src="{{ asset($pelicula->img) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class=" card-title">{{ $pelicula->name }}</h5>
                            <p class="card-text"><small class="text-muted">ültima actualización
                                    {{ $pelicula->updated_at }}</small></p></small></p>
                            <p class="card-text"><small class="text-muted"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-star"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                    </svg>
                                    {{ $pelicula->likes }}</small></p></small></p>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            setTimeout(() => {
                $(".alert").remove();
            }, 5000);

            $("#debe").val(currency(sDebe))
            $("#haber").val(currency(sHaber))
        });
    </script>

@endsection