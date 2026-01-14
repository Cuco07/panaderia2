@extends('template')

@section('title', 'Categorías')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
@endpush

@section('content')

{{-- Toast de éxito --}}
@if(session('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    Toast.fire({
        icon: "success",
        title: "{{ session('success') }}"
    });
</script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Categorías</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('panel') }}">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Categorías</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            Añadir nueva categoría
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de Categorías
        </div>

        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->nombre }}</td>

                            <td>{{ $categoria->descripcion }}</td>

                            <td>
                                @if ($categoria->estado)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="btn-group" role="group">

                                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <button
                                        type="button"
                                        class="btn btn-sm {{ $categoria->estado ? 'btn-danger' : 'btn-success' }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal-{{ $categoria->id }}">
                                        {{ $categoria->estado ? 'Eliminar' : 'Restaurar' }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal de confirmación --}}
                        <div class="modal fade" id="confirmModal-{{ $categoria->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        {{ $categoria->estado
                                            ? '¿Seguro deseas eliminar esta categoría?'
                                            : '¿Seguro deseas restaurar esta categoría?' }}
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn {{ $categoria->estado ? 'btn-danger' : 'btn-success' }}">
                                                Confirmar
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
