@extends('theme.base')
@section('content')

<div class="container">
    <div class="row mt-5 justify-content-center align-items-center">
        <div class="col-6 bg-light p-5">
            <h2>Registro</h2>
            <form action="{{route('Usuario.store')}}" method="post">

                @csrf
                <div class="mb-3">
                    <label for="nombreUsusario" class="form-label">Nombre de ususario</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ususario">
                    @error('username')
                            <div>
                                <small class="text-danger font-weight-bold">*{{$message}}</small>
                            </div>
                        @enderror
                </div>
            
                <div class="mb-3">
                    <label for="contra" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="**********">
                    @error('password')
                        <div>
                            <small class="text-danger font-weight-bold">*{{$message}}</small>
                        </div>
                    @enderror
                  </div>
            <div class="mb-3">
                  <button type="submit" class="btn btn-primary mt-3">Registrar</button>
            </form>
        </div>
        
    </div>
        
</div>
@endsection

