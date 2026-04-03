@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Central De Enfermería</strong> <small class="text-muted">Agenda del Día</small></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <p><strong>Fecha : </strong> {{ $fecha->format('d-m-Y') }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Horario</th>
                        <th>Médico</th>
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

                            @if ($cita)
                                <td>{{ $cita->medico->nombre_completo }}</td>
                                <td>{{ $cita->paciente->nombre_completo }}</td>
                                <td>{{ $cita->paciente->diagnostico->nombre }}</td>
                                <td>{{ $cita->paciente->afiliacion->afiliacion }}</td>
                                <td>{{ $cita->paciente->expediente }}</td>

                                <td>
                                    @if ($cita->signos_vitales == 0)

                                        <a href="{{ route('centralEnfermeriaTomaSignosVitalesCreate', $cita->id) }}" class="btn btn-sm btn-info btn-block" data-toggle="tooltip" title="INICIAR CITA">
                                            <x-lucide-heart-pulse style="width:16px; height:16px;" />
                                            TOMAR SIGNOS VITALES
                                        </a>

                                    @else

                                        <a href="{{ route('centralEnfermeriaTomaSignosVitalesShow', $cita->id) }}" class="btn btn-sm btn-success btn-block" data-toggle="tooltip" title="INICIAR CITA">
                                            <x-lucide-heart-plus style="width:16px; height:16px;" />
                                            VER SIGNOS VITALES
                                        </a>
                                        
                                    @endif
                                    
                                    
                                </td>
                            @else
                                <td colspan="5" class="text-center text-muted">
                                    Disponible
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer"></div>
    </div>

    <br>
@stop

@include('partials.footer')

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