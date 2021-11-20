@extends('theme.base')
@section('content')

<div class="container">
    <div class="row mt-5 justify-content-center align-items-center">
        <div class="col-6 bg-light p-5">
            <h2>Iniciar sesión</h2>
            <form action="{{route('login.loguear')}}" method="post">

                @csrf
                <div class="mb-3">
                    @if (session()->exists('estado'))
                        <div class="alert alert-{{ session()->get('alert') }}" role="alert">
                        {{ session()->get('estado') }}
                      </div>
                      @php
                        session()->forget('estado');
                        session()->forget('alert');
                      @endphp
                    @endif
                    <label for="nombreUsusario" class="form-label">Nombre de ususario</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ususario" value="{{old('username')}}">   
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
                  <button type="submit" class="btn btn-primary mt-3">Ingresar</button>
            </form>
        </div>
        
    </div>
        
</div>
@endsection

@section('script')
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
@endsection

