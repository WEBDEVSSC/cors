@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Médicos</strong> <small class="text-muted">Vacaciones</small></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('medicosIndex') }}" class="btn btn-info btn-sm float-right">
            <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL
        </a>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-md-3">
                <p><strong>Médico</strong></p>
                {{ $medico->nombre_completo }}
            </div>

            <div class="col-md-3">
                <p><strong>Especialidad</strong></p>
                {{ optional($medico->especialidad)->especialidad ?? 'Sin especialidad' }}
            </div>
        </div>

    </div>
    
</div>

{{-------------------------------------------------------------------}}

<div class="card">
    <div class="card-header">
        <strong>Programar Día de Vacaciones</strong>
    </div>
    <div class="card-body">

    <form action="{{ route('medicosVacacionesStore', $medico->id)}}" method="POST">

        @csrf

        <div class="row">
            <div class="col-md-3">
                <p><strong>Fecha</strong></p>
                <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}">
                
                @error('fecha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-3">
                <p><strong>Concepto</strong></p>
                <input type="text" class="form-control @error('concepto') is-invalid @enderror" name="concepto" value="{{ old('concepto') }}">
                
                @error('concepto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
            </div>
        </div>

    </div>
    <div class="card-footer">

        <button type="submit" class="btn btn-success btn-sm float-right">
            <i class="fa-solid fa-check"></i> REGISTRAR DATOS
        </button>

    </form>

    </div>
</div>

{{-------------------------------------------------------------------}}

<div class="card">
    <div class="card-header">
        <strong>Vacaciones Programadas</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medico->vacaciones as $index => $v)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->fecha)->format('d-m-Y') }}</td>
                                <td>{{ $v->concepto }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay vacaciones registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-------------------------------------------------------------------}}

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