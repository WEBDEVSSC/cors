@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Medicos</strong> <small class="text-muted">Agenda del Día</small></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <p><strong>Fecha : </strong> {{ $fecha }}</p>
            <p><strong>Médico : </strong>{{ $medico->nombre_completo }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">

            <a href="{{ route('buscadorCita') }}" class="btn btn-info btn-sm float-right">
                <i class="fa-solid fa-plus"></i> CITAS
            </a>

            <form action="{{ route('reportePDFCitas') }}" method="GET" target="_blank" class="float-right mr-2">
                
                @csrf

                <input type="hidden" name="medico_id" value="{{ $medico->id }}">
                <input type="hidden" name="fecha" value="{{ $fecha }}">
                
                <button type="submit" class="btn btn-secondary btn-sm float-right mr-2">
                    <i class="fa-solid fa-file-pdf"></i> PDF
                </button>
            </form>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Horario</th>
                        <th>Paciente</th>
                        <th>Diagnóstico</th>
                        <th>Afiliación</th>
                        <th>Expediente</th>
                        
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td>{{ $cita->hora->format('H:i') }}</td>
                            <td>{{ $cita->paciente->nombre_completo }}</td>
                            <td>{{ $cita->paciente->diagnostico->nombre }}</td>
                            <td>{{ $cita->paciente->afiliacion->afiliacion }}</td>
                            <td>{{ $cita->paciente->expediente }}</td>

                            <td>
                                <div class="d-flex gap-1">
                                    <form action="{{ route('medicoAgendaCitaDestroy', $cita) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('DELETE')                                    

                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="ELIMINAR">
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
                    text: "Se eliminará la cita",
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