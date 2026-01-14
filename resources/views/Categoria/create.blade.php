@extends('template')

@section('title','Crear Categoria')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Categoria</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('panel') }}">Inicio</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('categorias.index') }}">Categoria</a>
        </li>
        <li class="breadcrumb-item active">Crear Categoria</li>
    </ol>

    <div class="container w-100">
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        class="form-control"
                        value="{{ old('nombre') }}">
                    @error('nombre')
                    <small class="text-danger">{{ '* '.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea
                        name="descripcion"
                        id="descripcion"
                        rows="3"
                        class="form-control">{{ old('descripcion') }}</textarea>

                    @error('descripcion')
                    <small class="text-danger">{{ '* '.$message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-control">
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>

                </div>


                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection