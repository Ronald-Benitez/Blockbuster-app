<footer class="fixed-bottom bg-light">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="dropdown m-2 d-flex justify-content-center">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Selecionar tipo de orden
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a href="{{ route('Filtro.populares') }}" class="dropdown-item">
                                Ordenar por popularidad
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Filtro.nombre') }}" class="dropdown-item">
                                Ordenar por nombre
                            </a>
                        </li>
                        @if (session()->exists('idUser') && session()->get('typeUser') == 'admin')
                            <li>
                                <a href="{{ route('Filtro.disponibles') }}" class="dropdown-item">
                                    Ordenar por disponibles
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('Filtro.sinStock') }}" class="dropdown-item">
                                    Ordenar por sin stock
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
