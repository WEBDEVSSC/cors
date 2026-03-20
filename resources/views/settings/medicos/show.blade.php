@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Medicos</strong> <small class="text-muted">Detalles</small></h1>
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
                <p><strong>Nombre:</strong></p>
                <p>{{ $medico->nombre_completo }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Cédula:</strong></p>
                <p>{{ $medico->cedula }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Especialidad:</strong></p>
                <p>{{ $medico->especialidad->especialidad }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Contacto:</strong></p>
                <p>{{ $medico->correo }} | {{ $medico->celular }}</p>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><strong>DIA</strong></th>
                            <th><strong>HORARIO</strong></th>
                            <th><strong>CONSULTA</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>LUNES</td>
                            <td>{{ $medico->horario_lunes  }}</td>
                            <td>
                                @if($medico->lunes_consulta == 1)
                                    <span class="float-center badge bg-success">SI</span>
                                @else
                                    <span class="float-center badge bg-danger">NO</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>MARTES</td>
                            <td>{{ $medico->horario_martes  }}</td>
                            <td>
                                @if($medico->martes_consulta == 1)
                                    <span class="float-center badge bg-success">SI</span>
                                @else
                                    <span class="float-center badge bg-danger">NO</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>MIERCOLES</td>
                            <td>{{ $medico->horario_miercoles  }}</td>
                            <td>
                                @if($medico->miercoles_consulta == 1)
                                    <span class="float-center badge bg-success">SI</span>
                                @else
                                    <span class="float-center badge bg-danger">NO</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>JUEVES</td>
                            <td>{{ $medico->horario_jueves  }}</td>
                            <td>
                                @if($medico->jueves_consulta == 1)
                                    <span class="float-center badge bg-success">SI</span>
                                @else
                                    <span class="float-center badge bg-danger">NO</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>VIERNES</td>
                            <td>{{ $medico->horario_viernes  }}</td>
                            <td>
                                @if($medico->viernes_consulta == 1)
                                    <span class="float-center badge bg-success">SI</span>
                                @else
                                    <span class="float-center badge bg-danger">NO</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
        

          
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