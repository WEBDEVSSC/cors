@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Pacientes</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('medicosCreate') }}" class="btn btn-info btn-sm float-right">
                <i class="fa-solid fa-plus"></i> NUEVO REGISTRO
            </a>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>CURP</th>
                        <th>Diagnóstivo</th>
                        <th>Afiliación</th>
                        <th>Expediente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->nombre_completo; }}</td>
                            <td>{{ $paciente->curp; }}</td>
                            <td>{{ $paciente->diagnostico->nombre; }}</td>
                            <td>{{ $paciente->afiliacion->afiliacion; }}</td>
                            <td>{{ $paciente->expediente; }}</td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('medicosShow', $paciente) }}" class="btn btn-sm btn-info mr-1" data-toggle="tooltip"  title="DETALLES">
                                        <i class="fa-solid fa-eye text-white"></i>
                                    </a>

                                    <a href="{{ route('medicosVacacionesCreate', $paciente) }}" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" title="VACACIONES">
                                        <i class="fa-solid fa-calendar text-white"></i>
                                    </a>

                                    <a href="{{ route('medicosEdit', $paciente) }}" class="btn btn-sm btn-warning mr-1" data-toggle="tooltip" title="EDITAR">
                                        <i class="fa-solid fa-edit text-white"></i>
                                    </a>

                                    <form action="{{ route('medicosDestroy', $paciente) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="status" value="1">

                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="ACTIVAR">
                                            <i class="fa-solid fa-trash text-white"></i>
                                        </button>
                                    </form>
                                        

                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer"></div>
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
                    text: "Se modificara el status",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, modificar',
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