@extends('template')

@section('title','Crear Presentación')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Presentación</h1>

    <div class="card">
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">

            <form action="{{ route('presentaciones.store') }}" method="POST">
                @csrf

                {{-- Nombre --}}
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input
                        type="text"
                        name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre') }}"
                        required
                    >
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea
                        name="descripcion"
                        class="form-control @error('descripcion') is-invalid @enderror"
                        rows="3"
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="text-end">
                    <a href="{{ route('presentaciones.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
