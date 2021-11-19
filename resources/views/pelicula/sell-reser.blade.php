@if (isset($_SESSION['idUser']))
    <div class="row my-2">
        <div class="col-6">
            @if (isset($compra) && !empty($compra))
                <div class="my-2 d-flex">

                    <a class="btn btn-success flex-fill" style="cursor: default">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bag-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                        </svg>
                        <small>Comprada</small>
                    </a>
                </div>
            @else
                @if ($pelicula->stock > 0)
                    <form action="{{ route('Compra.store') }}" class="my-2 d-flex" method="post">
                        @csrf
                        <input type="text" class="invisible" name="idM" value="{{ $pelicula->id }}">
                        <button type="submit" class="btn btn-success flex-fill">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                            <small>Comprar</small>
                        </button>
                    </form>
                @else
                    <div class="my-2 d-flex">

                        <a class="btn btn-danger flex-fill" style="cursor: default">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-x" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6.146 8.146a.5.5 0 0 1 .708 0L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 0 1 0-.708z" />
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                            <small>Sin stock</small>
                        </a>
                    </div>
                @endif
            @endif

        </div>

        <div class="col-6">
            @if (isset($alquiler) && !empty($alquiler))
                <form action="" class="my-2 d.flex" method="post">
                    @method("delete")
                    @csrf
                    <button type="submit" class="btn btn-success flex-fill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-handbag-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 0-2 2v2H5V3a3 3 0 1 1 6 0v2h-1V3a2 2 0 0 0-2-2zM5 5H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11v1.5a.5.5 0 0 1-1 0V5H6v1.5a.5.5 0 0 1-1 0V5z" />
                        </svg>
                        <small>Rentada</small>
                    </button>
                </form>
        </div>
    @else
        <form action="" class="my-2 d-flex" method="post">
            @csrf
            <input type="text" class="invisible" name="idM" value="{{ $pelicula->id }}">
            <button type="submit" class="btn btn-success flex-fill">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-handbag" viewBox="0 0 16 16">
                    <path
                        d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z" />
                </svg>
                <small>Rentar</small>
            </button>
        </form>
@endif
</div>
</div>
@endif
