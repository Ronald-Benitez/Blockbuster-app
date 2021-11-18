@extends('theme.base')
@section('content')

<div class="container">
    <div class="row mt-5 justify-content-center align-items-center">
        <div class="col-6 bg-light p-5">
            <h2>Editar datos</h2>
            <form action="{{route('Usuario.update',$usuario->id)}}" method="post">
                
                @csrf
                
                @method('put')

                <label for="nombreUsusario" class="form-label">Nombre de ususario</label>
                <input type="text" class="form-control" id="username" name="username" value="{{$usuario->username}}" required>
            
                <div class="mb-3">
                    <label for="contra" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                  </div>
            <div class="mb-3">
                <select class="form-select" name="type" id="type" required >
                    <option selected value="">Tipo de ususario</option>
                    <option value="user">Ususario Normal</option>
                    <option value="admin">Administrador</option>
                  </select>
                  <button type="submit" class="btn btn-primary mt-3">Guardar</button>
            </form>
        </div>
        
    </div>
        
</div>
@endsection

