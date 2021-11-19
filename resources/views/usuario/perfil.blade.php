@extends('theme.base')
@section('content')
    

<div class="container mt-4">
    @if (isset($_SESSION['estado']))
    <div class="alert alert-{{ $_SESSION['alert'] }}" role="alert">
      {{ $_SESSION['estado'] }}
    </div>
    @php
      unset($_SESSION["estado"]); 
      unset($_SESSION["alert"]); 
    @endphp            
  @endif
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-Datos-tab" data-bs-toggle="tab" data-bs-target="#nav-Datos" type="button" role="tab" aria-controls="nav-Datos" aria-selected="true">Datos personales</button>
      <button class="nav-link" id="nav-Likes-tab" data-bs-toggle="tab" data-bs-target="#nav-Likes" type="button" role="tab" aria-controls="nav-Likes" aria-selected="false">Me gustan</button>
      <button class="nav-link" id="nav-Rentadas-tab" data-bs-toggle="tab" data-bs-target="#nav-Rentadas" type="button" role="tab" aria-controls="nav-Rentadas" aria-selected="false">Peliculas Rentadas</button>
      <button class="nav-link" id="nav-Compradas-tab" data-bs-toggle="tab" data-bs-target="#nav-Compradas" type="button" role="tab" aria-controls="nav-Compradas" aria-selected="false">Peliculas Compradas</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    {{-- Datos --}}
    <div class="tab-pane fade show active" id="nav-Datos" role="tabpanel" aria-labelledby="nav-Datos-tab">
      
      <div class="card">
        <div class="card-header">
          Nombre de Usuario
        </div>
        <div class="card-body">
          <p class="card-text">{{$usuario->username}}</p>
        </div>
        <div class="card-header">
          Tipo de ususario
        </div>
        <div class="card-body">
          <p class="card-text">{{$usuario->type}}</p>
        </div>
      </div>
    </div>
    {{-- Likes --}}
    <div class="tab-pane fade" id="nav-Likes" role="tabpanel" aria-labelledby="nav-Likes-tab">
      2
    </div>
    {{-- Peliculas rentadas --}}
    <div class="tab-pane fade" id="nav-Rentadas" role="tabpanel" aria-labelledby="nav-Rentadas-tab">
      3
    </div>
    {{-- Peliculas compradas --}}
    <div class="tab-pane fade" id="nav-Compradas" role="tabpanel" aria-labelledby="nav-Compradas-tab">
      4
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
