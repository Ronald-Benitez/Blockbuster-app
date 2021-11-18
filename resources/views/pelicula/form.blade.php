@extends('theme.base')

@section('content')

    <div class="container mt-3">
        <p class="fs-1 text-center ">Registro de película</p>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="{{ route('Pelicula.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6"><label class="form-label">Nombre</label>
                    <input type="text" name="name" id="" class="form-control m-2" required>
                    @error('file')
                        <small class="text-warning m-2">Nombre requerido</small><br>
                    @enderror

                    <label class="form-label">Sinopsis</label>
                    <textarea name="synopsis" id="" cols="30" rows="10" class="form-control m-2" required></textarea>
                    @error('file')
                        <small class="text-warning m-2">Sinopsis requerida</small><br>
                    @enderror

                    <input type="file" name="file" id="" class="form-control m-2" accept="image/*" required>
                    @error('file')
                        <small class="text-warning m-2">El archivo debe de ser una imagén no mayor a 2 MB</small><br>
                    @enderror
                </div>
                <div class="col-lg-6"><label class="form-label">Precio de venta</label>
                    <input type="number" step="0.01" name="sellP" id="" class="form-control m-2" required>
                    @error('sellP')
                        <small class="text-warning m-2">Precio de venta no menor a 0 requerido</small><br>
                    @enderror

                    <label class="form-label">Precio de reservacion</label>
                    <input type="text" name="reservationP" id="" class="form-control m-2" required>
                    @error('reservationP')
                        <small class="text-warning m-2">Precio de reservación no menor a 0 requerido</small><br>
                    @enderror

                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" id="" step="1" class="form-control m-2" required>
                    @error('stock')
                        <small class="text-warning m-2">Stock no menor a 0 requerido</small><br>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-outline-dark m-2">
                    Guardar película
                </button>
            </div>

        </form>
    </div>
@endsection
