<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        {{-- icono --}}
        <a class="navbar-brand" href="{{ route('Pelicula.index') }}">
            <img src="https://img.icons8.com/doodle/48/000000/minecraft-grass-cube.png" alt="" width="30" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown"
            aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            {{-- Valorez Izquierda --}}
            <ul class="navbar-nav">
                <li class="nav-item me-4">
                    <a class="nav-link active" aria-current="page" href="{{ route('Pelicula.index') }}">Inicio</a>
                </li>
                {{-- busqueda --}}
                <form class="d-flex" action="{{ route('Filtro.search') }}" method="POST">
                    @csrf
                    <input class="form-control me-3" type="search" name="search" placeholder="Nombre de pelicula."
                        aria-label="">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
        </div>
        {{-- Valores Derecha --}}
        <div class="mx-2">
            <a type="button" class="btn btn-outline-info" href="{{ route('login.loguear') }}">Iniciar sesión</a>
            <a type="button" class="btn btn-outline-warning ms-1" href="{{ route('Usuario.create') }}">Registrarse</a>
        </div>

    </div>

    </div>

    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('Pelicula.index') }}">
            <img src="https://img.icons8.com/doodle/48/000000/minecraft-grass-cube.png" alt="" width="30" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('Pelicula.index') }}">Inicio</a>
                </li>
            </ul>
            <form class="d-flex" action="{{ route('Filtro.search') }}" method="POST">
                @csrf
                <input class="form-control me-3" type="search" name="search" placeholder="Nombre de pelicula."
                    aria-label="">
                <button class="btn btn-outline-info" type="submit">Buscar</button>
            </form>
            <a type="button" class="btn btn-info mx-2" href="{{ route('login.loguear') }}">Iniciar
                sesión</a>
            <a type="button" class="btn btn-warning mx-2" href="{{ route('Usuario.create') }}">Registrarse</a>

        </div>

    </div>
</nav>
