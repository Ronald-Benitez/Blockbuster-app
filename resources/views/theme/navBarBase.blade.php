<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
      {{-- icono --}}
    <a class="navbar-brand" href="{{route('Pelicula.index')}}">
      <img src="https://img.icons8.com/doodle/48/000000/minecraft-grass-cube.png" alt="" width="30" height="24">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      {{-- Valorez Izquierda --}}
      <ul class="navbar-nav">
          <li class="nav-item me-4">
            <a class="nav-link active" aria-current="page" href="{{route('Pelicula.index')}}">Inicio</a>
          </li>
          <form class="d-flex" action="" method="POST">
            <input class="form-control me-3" type="search" placeholder="Nombre de pelicula." aria-label="">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
          </form>
    </div>
    {{-- Valores Derecha --}}
    <div class="mx-5">
      <a type="button" class="btn btn-outline-info" href="{{route('login.loguear')}}">Iniciar sesión</a>
    </div>
    
    </div>

    </div>
        
  </div>
</nav>