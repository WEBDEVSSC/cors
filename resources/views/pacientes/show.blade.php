@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Pacientes</strong> <small class="text-muted">Detalles</small></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('pacientesIndex') }}" class="btn btn-info btn-sm float-right">
            <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL
        </a>
    </div>

        <div class="card-body">

            <p><strong>Datos Generales</strong></p>

            <div class="row">
                <div class="col-md-3">
                    <p><strong>Nombre:</strong></p>
                     {{ $paciente->nombre_completo }}
                </div>

                <div class="col-md-3">
                    <p><strong>CURP</strong></p>
                    {{ $paciente->curp }}
                </div>

                <div class="col-md-3">
                    <p><strong>Sexo</strong></p>
                    {{ $paciente->sexo }}
                </div>

                <div class="col-md-3">
                    <p><strong>Estado Civil</strong></p>
                    {{ $paciente->estado_civil }}
                </div>
            </div>
 
        </div>

        <div class="card-footer">

            
        </div>
    
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