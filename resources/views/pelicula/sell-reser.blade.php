@if (session()->exists('idUser'))
    <div class="row my-2">
        <div class="col-6">
            @if (isset($compra) && !empty($compra))
                <form action="{{ route('Compra.store') }}" class="my-2 d-flex" method="post">
                    @csrf
                    <input type="text" class="invisible" name="idM" value="{{ $pelicula->id }}">

                    @if ($pelicula->stock > 0)
                        <button type="submit" class="btn btn-success flex-fill"
                            onclick="return confirm('Película ya comprada ¿desea comprar otra?')">
                        @else
                            <button type="" class="btn btn-success flex-fill"
                                onclick="return alert('Película sin stock')">
                    @endif

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <small>Comprada</small>
                    </button>

                </form>
            @else
                @if ($pelicula->stock > 0)
                    <form action="{{ route('Compra.store') }}" class="my-2 d-flex" method="post">
                        @csrf
                        <input type="text" class="invisible" name="idM" value="{{ $pelicula->id }}">
                        <button type="submit" class="btn btn-success flex-fill">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <small>Comprar</small>
                        </button>
                    </form>
                @else
                    <div class="my-2 d-flex">

                        <a class="btn btn-danger flex-fill" style="cursor: default"
                            onclick="return alert('Película sin stock')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart-x-fill" viewBox="0 0 16 16">
                                <path
                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7.354 5.646 8.5 6.793l1.146-1.147a.5.5 0 0 1 .708.708L9.207 7.5l1.147 1.146a.5.5 0 0 1-.708.708L8.5 8.207 7.354 9.354a.5.5 0 1 1-.708-.708L7.793 7.5 6.646 6.354a.5.5 0 1 1 .708-.708z" />
                            </svg>
                            <small>Sin stock</small>
                        </a>
                    </div>
                @endif
            @endif

        </div>
        {{-- Renta --}}
        <div class="col-6">
            @if (isset($alquiler) && !empty($alquiler) && $alquiler->state == 1)
                @if ($retraso > 0)
                    <div class="d-flex my-2">
                        <a href="{{ route('Reservacion.show', $alquiler->id) }}" class="btn btn-success flex-fill">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                            </svg>
                            <small>Regresar</small>
                        </a>
                    </div>
                @else
                    <form action="{{ route('Reservacion.show', $alquiler->id) }}" method="post" class="my-2 d-flex"
                        method="post">
                        @method("delete")
                        @csrf

                        <button type="submit" class="btn btn-success flex-fill">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                            </svg>
                            <small>Regresar</small>
                        </button>

                    </form>
                @endif
            @else
                @if ($pelicula->stock > 0)
                    <form action="{{ route('Reservacion.store') }}" class="my-2 d-flex" method="post">
                        @csrf
                        <input type="text" class="invisible" name="idM" value="{{ $pelicula->id }}">
                        <button type="submit" class="btn btn-success flex-fill">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                            <small>Rentar</small>
                        </button>
                    </form>
                @else
                    <div class="my-2 d-flex">

                        <a class="btn btn-danger flex-fill" style="cursor: default"
                            onclick="return alert('Película sin stock')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293 6.854 8.146z" />
                            </svg>
                            <small>Sin stock</small>
                        </a>
                    </div>
                @endif
            @endif
        </div>
    @else

@endif
</div>
