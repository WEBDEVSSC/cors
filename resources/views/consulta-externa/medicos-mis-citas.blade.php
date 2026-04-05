@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Medicos</strong> <small class="text-muted">Agenda del Día</small></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <p><strong>Fecha : </strong> {{ $fecha->format('d-m-Y') }}</p>
            <p><strong>Médico : </strong>{{ $medico->nombre_completo }}</p>
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
                        <th>Paciente</th>
                        <th>Diagnóstico</th>
                        <th>Afiliación</th>
                        <th>Expediente</th>
                        <th><center>Signos Vitales</center></th>
                        <th>Valoración Inicial</th>
                        
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $hora)
                        @php
                            $cita = $citasPorHora[$hora] ?? null;
                        @endphp

                        <tr>
                            <td>{{ $hora }}</td>

                            @if ($cita)
                                <td>{{ $cita->paciente->nombre_completo }}</td>
                                <td>{{ $cita->paciente->diagnostico->nombre }}</td>
                                <td>{{ $cita->paciente->afiliacion->afiliacion }}</td>
                                <td>{{ $cita->paciente->expediente }}</td>

                                <td>
                                    @if ($cita->signos_vitales==0)

                                        <center>
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="SIN REGISTRO">
                                                <x-lucide-heart-minus style="width:16px; height:16px;" />
                                            </button>
                                        </center>

                                    @else
                                    
                                        <center>
                                            <button class="btn btn-sm btn-success" data-toggle="tooltip" title="REGISTRADOS">
                                                <x-lucide-heart-plus style="width:16px; height:16px;" />
                                            </button>
                                        </center>

                                    @endif
                                </td>

                                <td>
                                    @if($cita->valoracionInicial)
                                        <a href="{{ route('medicoValoracionInicialShow',$cita->id) }}">
                                            <button type="submit" 
                                                class="btn btn-success btn-sm d-inline-flex align-items-center" 
                                                style="gap:6px; border-radius:6px;">

                                                <x-lucide-heart-plus style="width:16px; height:16px;"/>
                                                VER
                                            </button>
                                        </a>
                                    @else

                                        <a href="{{ route('medicoValoracionInicialCreate',$cita->id) }}">
                                            <button type="submit" 
                                                class="btn btn-danger btn-sm d-inline-flex align-items-center" 
                                                style="gap:6px; border-radius:6px;">

                                                <x-lucide-clipboard-plus style="width:16px; height:16px;"/>
                                                REGISTRAR
                                            </button>
                                        </a>

                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('iniciarCita', $cita->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="INICIAR CITA">
                                        <i class="fas fa-stethoscope"></i> INICIAR CITA
                                    </a>
                                </td>
                            @else
                                <td colspan="7" class="text-center text-muted">
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