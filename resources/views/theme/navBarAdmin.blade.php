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
        {{-- administracion --}}
        <div class="mx-3">
            <div class="btn-group">
              <button type="button " class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    Administrar
                </button>
              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end dropdown-menu-lg-start">
                <li><a class="dropdown-item" href="{{route('Usuario.index')}}">Usuarios</a></li>
                <li><a class="dropdown-item" href="{{route('Compra.index')}}">Compra de peliculas</a></li>
                <li><a class="dropdown-item" href="{{route('Reservacion.index')}}">Renta de peliculas</a></li>
              </ul>
            </div>
          </div>
        {{-- busqueda --}}
            <form class="d-flex" action="" method="POST">
              <input class="form-control me-3" type="search" placeholder="Nombre de pelicula." aria-label="">
              <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
      </div>
      {{-- Valores Derecha --}}
      <div class="mx-5">
        <div class="btn-group me-3">
          <button type="button " class="btn btn-secondary dropdown-toggle me-3" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
              <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
            </svg>
            {{session()->get('username')}}
          </button>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end dropdown-menu-lg-start me-3">
            <li><a class="dropdown-item" href="{{route('Usuario.show',session()->get('idUser'))}}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
              Perfil
              </a></li>
            <li><a class="dropdown-item" href="{{route('login.logout')}}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
              Cerrar Session
            </a></li>
          </ul>
        </div>
      </div>
      
      </div>
  
      </div>
          
    </div>
  </nav>