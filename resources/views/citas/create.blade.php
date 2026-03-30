@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Citas</strong></h1>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header"></div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-3"><center><strong>Fecha: </strong>{{ \Carbon\Carbon::parse($fecha)->format('d-m-Y') }}</center></div>
            <div class="col-md-3"><center><strong>Médico: </strong>{{ $consultaHorarioUno->medico->nombre_completo ?? '' }}</center></div>
            <div class="col-md-3"><center><strong>Paciente: </strong>{{ $consultaHorarioUno->paciente->nombre_completo_completo ?? '' }}</center></div>
            <div class="col-md-3"><center><strong>Diagnóstico: </strong>{{ $consultaHorarioUno->paciente->diagnostico->nombre ?? '' }}</center></div>
        </div>
    </div>
</div>

    <div class="row mt-3">
        <div class="col-md-6">
                <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Horario</th>
                        <th>Paciente</th>
                        <th>Expediente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8:00</td>
                        <td>
                            @if($consultaHorarioUno)
                                 {{ $consultaHorarioUno->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="08:00:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioUno->paciente->expediente ?? '' }} - {{ $consultaHorarioUno->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                        
                    </tr>
                    <tr>
                        <td>8:30</td>
                        <td>
                            @if ($consultaHorarioDos)
                                {{ $consultaHorarioDos->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="08:30:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>

                        <td>
                            {{ $consultaHorarioDos->paciente->expediente ?? '' }} - {{ $consultaHorarioDos->paciente->afiliacion->afiliacion ?? '' }}
                        </td>

                    </tr>
                    <tr>
                        <td>9:00</td>
                        <td>
                            @if ($consultaHorarioTres)
                                {{ $consultaHorarioTres->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="09:00:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                            </td>

                            <td>
                            {{ $consultaHorarioTres->paciente->expediente ?? '' }} - {{ $consultaHorarioTres->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>9:30</td>
                        <td>
                            @if ($consultaHorarioCuatro)
                                {{ $consultaHorarioCuatro->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="09:30:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif

                           </td>
                           <td>
                            {{ $consultaHorarioCuatro->paciente->expediente ?? '' }} - {{ $consultaHorarioCuatro->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>10:00</td>
                        <td>
                            @if ($consultaHorarioCinco)
                                {{ $consultaHorarioCinco->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="10:00:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                            </td>
                            <td>
                            {{ $consultaHorarioCinco->paciente->expediente ?? '' }} - {{ $consultaHorarioCinco->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>10:30</td>
                        <td>
                            @if ($consultaHorarioSeis)
                                {{ $consultaHorarioSeis->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="10:30:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif

                            </td>
                            <td>
                            {{ $consultaHorarioSeis->paciente->expediente ?? '' }} - {{ $consultaHorarioSeis->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>11:00</td>
                        <td>
                            @if ($consultaHorarioSiete)
                                {{ $consultaHorarioSiete->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="11:00:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioSiete->paciente->expediente ?? '' }} - {{ $consultaHorarioSiete->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
        </div>
        <div class="col-md-6">

            <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Horario</th>
                        <th>Paciente</th>
                        <th>Expediente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>11:30</td>
                        <td>
                            @if ($consultaHorarioOcho)
                                {{ $consultaHorarioOcho->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="11:30:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioOcho->paciente->expediente ?? '' }} - {{ $consultaHorarioOcho->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>12:00</td>
                        <td>
                            @if ($consultaHorarioNueve)
                                {{ $consultaHorarioNueve->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="12:00:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioNueve->paciente->expediente ?? '' }} - {{ $consultaHorarioNueve->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>12:30</td>
                        <td>
                            @if ($consultaHorarioDiez)
                                {{ $consultaHorarioDiez->paciente->nombre_completo ?? '' }}  
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="12:30:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioDiez->paciente->expediente ?? '' }} - {{ $consultaHorarioDiez->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>13:00</td>
                        <td>
                            @if ($consultaHorarioOnce)
                                {{ $consultaHorarioOnce->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="13:00:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioOnce->paciente->expediente ?? '' }} - {{ $consultaHorarioOnce->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>13:30</td>
                        <td>
                            @if ($consultaHorarioDoce)
                                {{ $consultaHorarioDoce->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="13:30:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioDoce->paciente->expediente ?? '' }} - {{ $consultaHorarioDoce->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>14:00</td>
                        <td>
                            @if ($consultaHorarioTrece)
                                {{ $consultaHorarioTrece->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="14:00:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioTrece->paciente->expediente ?? '' }} - {{ $consultaHorarioTrece->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>14:30</td>
                        <td>
                            @if ($consultaHorarioCatorce)
                                {{ $consultaHorarioCatorce->paciente->nombre_completo ?? '' }}
                            @else
                                <form action="{{route('storeCita')}}" method="POST">
                            
                                    @csrf

                                    <input type="hidden" name="medico_id" value="{{ $medico_id }}">
                                    <input type="hidden" name="paciente_id" value="{{ $paciente_id }}">
                                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                                    <input type="hidden" name="hora" value="14:30:00">

                                    <button type="submit" 
                                        class="btn btn-info btn-sm d-inline-flex align-items-center" 
                                        style="gap:6px; border-radius:6px;">

                                        <x-lucide-calendar-heart style="width:16px; height:16px;"/>
                                        REGISTRAR CITA
                                    </button>

                                </form>
                            @endif
                        </td>
                        <td>
                            {{ $consultaHorarioCatorce->paciente->expediente ?? '' }} - {{ $consultaHorarioCatorce->paciente->afiliacion->afiliacion ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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
@stop