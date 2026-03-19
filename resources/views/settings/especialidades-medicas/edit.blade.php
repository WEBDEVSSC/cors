@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Especialidades Médicas</strong> <small class="text-muted">Editar Registro</small></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('especialidadesMedicasIndex') }}" class="btn btn-info btn-sm float-right">
            <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL
        </a>
    </div>

    <form action="{{ route('especialidadesMedicasUpdate', $especialidadMedica->id) }}" method="POST">
        @csrf

        @method('PUT')

        <div class="card-body">

            {{-- DATOS GENERALES --}}
            <div class="row">
                <div class="col-md-3">
                    <label>Especialidad</label>
                    <input type="text" class="form-control @error('especialidad') is-invalid @enderror"
                        name="especialidad" value="{{ old('especialidad', $especialidadMedica->especialidad) }}">
                    @error('especialidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
    
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm float-right">
                <i class="fa-solid fa-check"></i> REGISTRAR DATOS
            </button>
        </div>
    </form>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: '{{ session('warning') }}'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Información',
                text: '{{ session('info') }}'
            });
        @endif
    </script>

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Este registro se eliminará",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop