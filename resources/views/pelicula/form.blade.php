@extends('theme.base')

@section('content')


    @if (isset($pelicula))
        <div class="container mt-3">
            <p class="fs-1 text-center ">Actualización de película</p>
        </div>

        @php
            $data = $pelicula;
        @endphp
    @else
        <div class="container mt-3">
            <p class="fs-1 text-center ">Registro de película</p>
        </div>
    @endif
    <div class="container d-flex justify-content-center my-5">
        @if (isset($pelicula))
            <form action="{{ route('Pelicula.update', $pelicula->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
            @else
                <form action="{{ route('Pelicula.store') }}" method="post" enctype="multipart/form-data">
        @endif

        @csrf

        <div class="row">
            <div class="col-lg-6"><label class="form-label">Nombre</label>
                <input type="text" name="name" id="" class="form-control m-2" required value="{{ $data->name }}">
                @error('file')
                    <small class="text-warning m-2">Nombre requerido</small><br>
                @enderror

                <label class="form-label">Sinopsis</label>
                <textarea name="synopsis" id="" cols="30" rows="10" class="form-control m-2"
                    required>{{ $data->synopsis }}</textarea>
                @error('file')
                    <small class="text-warning m-2">Sinopsis requerida</small><br>
                @enderror

                @if (isset($pelicula))
                    <input type="file" name="file" id="" class="form-control m-2" accept="image/*">
                @else
                    <input type="file" name="file" id="" class="form-control m-2" accept="image/*" required>
                    @error('sellP')
                        <small class="text-warning m-2">Imagén requerida</small><br>
                    @enderror
                @endif

            </div>
            <div class="col-lg-6"><label class="form-label">Precio de venta</label>
                <input type="number" step="0.01" name="sellP" id="" class="form-control m-2" required
                    value="{{ $data->sellP }}">
                @error('sellP')
                    <small class="text-warning m-2">Precio de venta no menor a 0 requerido</small><br>
                @enderror

                <label class="form-label">Precio de reservacion</label>
                <input type="text" name="reservationP" id="" class="form-control m-2" required
                    value="{{ $data->reservationP }}">
                @error('reservationP')
                    <small class="text-warning m-2">Precio de reservación no menor a 0 requerido</small><br>
                @enderror

                <label class="form-label">Stock</label>
                <input type="number" name="stock" id="" step="1" class="form-control m-2" required
                    value="{{ $data->stock }}">
                @error('stock')
                    <small class="text-warning m-2">Stock no menor a 0 requerido</small><br>
                @enderror
            </div>
        </div>


        <div class="container d-flex flex-column">
            @if (isset($pelicula))
                <button type="submit" class="btn btn-outline-dark d-block my-2 flex-fill">
                    Actualizar película
                </button>
            @else
                <button type="submit" class="btn btn-outline-dark d-block my-2">
                    Guardar película
                </button>
            @endif

        </div>

        </form>
    </div>
@endsection

@section('footer')
    @include('theme.footer-previous')
@endsection
