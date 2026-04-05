@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Valoración Inicial</strong> <small class="text-muted">Detalles de la Valoración Inicial</small></h1>
@stop

@section('content')

<div class="d-flex justify-content-end">
    <a href="{{ route('medicoValoracionInicialPDF',$valoracionInicial->id) }}" target="_blank">
        <button type="button" 
            class="btn btn-danger btn-sm d-inline-flex align-items-center" 
            style="gap:6px; border-radius:6px;">

            <x-lucide-file-user style="width:16px; height:16px;"/>
            IMPRIMIR PDF
        </button>
    </a>
</div>

<br>

{{--------------------------------------------------------------------------------------------------------}}
{{-- DATOS GENERALES DEL PACIENTE --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="card">
    <div class="card-header"><strong>Datos Generales del Paciente</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <p><strong>CURP</strong></p>
                <p>{{ $valoracionInicial->paciente->curp ?? '' }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Nombre</strong></p>
                <p>{{ $valoracionInicial->paciente->nombre_completo ?? '' }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>Edad</strong></p>
                {{ $valoracionInicial->edad_paciente }} años
            </div>
            <div class="col-md-2">
                <p><strong>Sexo</strong></p>
                {{ $valoracionInicial->paciente->sexo ?? '' }}
            </div>
            <div class="col-md-3">
                <p><strong>Residente</strong></p>
                <p>{{ $valoracionInicial->paciente->residencia ?? '' }}</p>
            </div>
            
        </div>

        <div class="row mt-3">
            <div class="col-md-2">
                <p><strong>Ocupación</strong></p>
                <p>{{ $valoracionInicial->paciente->ocupacion ?? '' }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Teléfono</strong></p>
                <p>{{ $valoracionInicial->paciente->telefono ?? '' }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>Fecha de Nacimiento</strong></p>
                <p>{{ $valoracionInicial->paciente->fecha_nacimiento ? $valoracionInicial->paciente->fecha_nacimiento->format('d-m-Y') : '' }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>Expediente</strong></p>
                <p>{{ $valoracionInicial->paciente->expediente ?? '' }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Afiliación</strong></p>
                <p>{{ $valoracionInicial->paciente->afiliacion->afiliacion ?? '' }}</p>
            </div>
        </div>
    </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- PADECIMIENTO ACTUAL --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="card">
    <div class="card-header"><strong>Padecimiento Actual (Oncológico)</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p>{{ $valoracionInicial->padecimiento_actual ?? '' }}</p>
            </div>
        </div>
    </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- SIGNOS VITALES Y EXPLORACIÓN FÍSICA --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="card">
    <div class="card-header">
        <strong>Signos Vitales y Exploración Física</strong>
    </div>

        <div class="card-body">

           
            <div class="row">

                <div class="col-md-2">
                    <p><strong>Peso (kg)</strong></p>
                    {{ $valoracionInicial->cita->peso }}
                </div>

                <div class="col-md-2">
                    <p><strong>Talla (cm)</strong></p>
                    {{ $valoracionInicial->cita->talla }}
                </div>

                <div class="col-md-2">
                <p><strong>IMC</strong></p>

                @php $imc = $valoracionInicial->cita->imc; @endphp

                @if($imc)
                    @if($imc < 18.5)
                        <span class="badge badge-warning">
                            {{ $imc }} - Bajo peso
                        </span>
                    @elseif($imc < 25)
                        <span class="badge badge-success">
                            {{ $imc }} - Normal
                        </span>
                    @elseif($imc < 30)
                        <span class="badge badge-warning">
                            {{ $imc }} - Sobrepeso
                        </span>
                    @elseif($imc < 35)
                        <span class="badge badge-danger">
                            {{ $imc }} - Obesidad I
                        </span>
                    @elseif($imc < 40)
                        <span class="badge badge-danger">
                            {{ $imc }} - Obesidad II
                        </span>
                    @else
                        <span class="badge badge-dark">
                            {{ $imc }} - Obesidad III
                        </span>
                    @endif
                @else
                    <span class="text-muted">Sin datos</span>
                @endif
            </div>

            {{--------------------------------------------------------------}}

            <div class="col-md-2">
            <p><strong>Presión Arterial (mmHg)</strong></p>

            @php
                $sis = $valoracionInicial->cita->sistolica;
                $dia = $valoracionInicial->cita->diastolica;
            @endphp

            @if($sis && $dia)

                {{-- Hipertensión II --}}
                @if($sis >= 140 || $dia >= 90)
                    <span class="badge badge-danger">
                        {{ $sis }} / {{ $dia }} - Hipertensión II
                    </span>

                {{-- Hipertensión I --}}
                @elseif(($sis >= 130 && $sis < 140) || ($dia >= 80 && $dia < 90 && $sis >= 130))
                    <span class="badge badge-warning">
                        {{ $sis }} / {{ $dia }} - Hipertensión I
                    </span>

                {{-- Normal (incluye 120/80) --}}
                @elseif($sis >= 90 && $sis <= 120 && $dia >= 60 && $dia <= 80)
                    <span class="badge badge-success">
                        {{ $sis }} / {{ $dia }} - Normal
                    </span>

                {{-- Elevada (solo sistólica 120-129 y diastólica <80) --}}
                @elseif($sis > 120 && $sis < 130 && $dia < 80)
                    <span class="badge badge-info">
                        {{ $sis }} / {{ $dia }} - Elevada
                    </span>

                {{-- Baja --}}
                @else
                    <span class="badge badge-warning">
                        {{ $sis }} / {{ $dia }} - Baja
                    </span>
                @endif

            @else
                <span class="text-muted">Sin datos</span>
            @endif
        </div>
        
            {{-------------------------}}

            <div class="col-md-2">
            <p><strong>Frecuencia Cardíaca (bpm)</strong></p>

            @php
                $fc = $valoracionInicial->cita->cardiaca;
            @endphp

            @if($fc)

                {{-- Taquicardia --}}
                @if($fc > 120)
                    <span class="badge badge-danger">
                        {{ $fc }} bpm - Alta
                    </span>

                {{-- Alta leve --}}
                @elseif($fc > 100)
                    <span class="badge badge-warning">
                        {{ $fc }} bpm - Elevada
                    </span>

                {{-- Normal --}}
                @elseif($fc >= 60 && $fc <= 100)
                    <span class="badge badge-success">
                        {{ $fc }} bpm - Normal
                    </span>

                {{-- Bradicardia --}}
                @else
                    <span class="badge badge-info">
                        {{ $fc }} bpm - Baja
                    </span>
                @endif

            @else
                <span class="text-muted">Sin datos</span>
            @endif
        </div>

             {{-------------------------}}

            <div class="col-md-2">
            <p><strong>Temperatura (°C)</strong></p>

            @php
                $temp = $valoracionInicial->cita->temperatura;
            @endphp

            @if($temp)

                {{-- Fiebre alta --}}
                @if($temp > 39)
                    <span class="badge badge-danger">
                        {{ $temp }} °C - Fiebre alta
                    </span>

                {{-- Fiebre --}}
                @elseif($temp >= 38.1)
                    <span class="badge badge-warning">
                        {{ $temp }} °C - Fiebre
                    </span>

                {{-- Febrícula --}}
                @elseif($temp >= 37.5)
                    <span class="badge badge-info">
                        {{ $temp }} °C - Febrícula
                    </span>

                {{-- Normal --}}
                @elseif($temp >= 35.5)
                    <span class="badge badge-success">
                        {{ $temp }} °C - Normal
                    </span>

                {{-- Hipotermia --}}
                @else
                    <span class="badge badge-dark">
                        {{ $temp }} °C - Hipotermia
                    </span>
                @endif

            @else
                <span class="text-muted">Sin datos</span>
            @endif
        </div>

              
                

            </div> 

            <hr>

            <div class="row mt-3">
                {{-------------------------}}

              <div class="col-md-2">
                <p><strong>Frecuencia Respiratoria (rpm)</strong></p>

                @php
                    $fr = $valoracionInicial->cita->respiratoria;
                @endphp

                @if($fr)

                    {{-- Taquipnea --}}
                    @if($fr > 24)
                        <span class="badge badge-danger">
                            {{ $fr }} rpm - Alta
                        </span>

                    {{-- Elevada --}}
                    @elseif($fr > 20)
                        <span class="badge badge-warning">
                            {{ $fr }} rpm - Elevada
                        </span>

                    {{-- Normal --}}
                    @elseif($fr >= 12 && $fr <= 20)
                        <span class="badge badge-success">
                            {{ $fr }} rpm - Normal
                        </span>

                    {{-- Bradipnea --}}
                    @else
                        <span class="badge badge-info">
                            {{ $fr }} rpm - Baja
                        </span>
                    @endif

                @else
                    <span class="text-muted">Sin datos</span>
                @endif
            </div>

            {{-------------------------}}

            <div class="col-md-2">
            <p><strong>Saturación de oxígeno (SpO₂ %)</strong></p>

            @php
                $spo2 = $valoracionInicial->cita->saO2;
            @endphp

            @if($spo2)

                {{-- Crítica --}}
                @if($spo2 < 88)
                    <span class="badge badge-dark">
                        {{ $spo2 }} % - Crítica
                    </span>

                {{-- Baja --}}
                @elseif($spo2 < 92)
                    <span class="badge badge-danger">
                        {{ $spo2 }} % - Baja
                    </span>

                {{-- Baja leve --}}
                @elseif($spo2 < 95)
                    <span class="badge badge-warning">
                        {{ $spo2 }} % - Baja leve
                    </span>

                {{-- Normal --}}
                @else
                    <span class="badge badge-success">
                        {{ $spo2 }} % - Normal
                    </span>
                @endif

            @else
                <span class="text-muted">Sin datos</span>
            @endif
        </div>

            {{-------------------------}}

            <div class="col-md-2">
            <p><strong>Dolor</strong></p>

            @php
                $dolor = $valoracionInicial->cita->dolor;
            @endphp

                @if(!is_null($dolor))

                    @if($dolor == 0)
                        <span class="badge badge-success">
                            0 - Sin dolor
                        </span>

                    @elseif($dolor == 1)
                        <span class="badge badge-success">
                            1 - Muy leve
                        </span>

                    @elseif($dolor == 2)
                        <span class="badge badge-success">
                            2 - Leve
                        </span>

                    @elseif($dolor == 3)
                        <span class="badge badge-info">
                            3 - Leve a moderado
                        </span>

                    @elseif($dolor == 4)
                        <span class="badge badge-warning">
                            4 - Moderado
                        </span>

                    @elseif($dolor == 5)
                        <span class="badge badge-warning">
                            5 - Moderado a intenso
                        </span>

                    @elseif($dolor == 6)
                        <span class="badge badge-danger">
                            6 - Intenso
                        </span>

                    @elseif($dolor == 7)
                        <span class="badge badge-danger">
                            7 - Muy intenso
                        </span>

                    @elseif($dolor == 8)
                        <span class="badge badge-danger">
                            8 - Severo
                        </span>

                    @elseif($dolor == 9)
                        <span class="badge badge-dark">
                            9 - Muy severo
                        </span>

                    @elseif($dolor == 10)
                        <span class="badge badge-dark">
                            10 - Insoportable
                        </span>

                    @endif

                @else
                    <span class="text-muted">Sin datos</span>
                @endif
            </div>
            {{-------------------------}}

            <div class="col-md-2">
            <p><strong>¿Ha presentado caídas?</strong></p>

            @php
                $caidas = $valoracionInicial->cita->caidas;
            @endphp

            @if(!is_null($caidas))

                @if($caidas)
                    <span class="badge badge-danger">
                        Sí - Riesgo de caída
                    </span>
                @else
                    <span class="badge badge-success">
                        No - Sin riesgo
                    </span>
                @endif

            @else
                <span class="text-muted">Sin datos</span>
            @endif
        </div>

            {{-------------------------}}
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <p><strong>Exploración Física</strong></p>
                    <p>{{ $valoracionInicial->cita->exploracion_fisica ?? '' }}</p>
                </div>
            </div>

        </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- ESTUDIOS DE LABORATORIO E IMAGEN --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="card">
    <div class="card-header"><strong>Estudios de Laboratorio e Imagen</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p>{{ $valoracionInicial->estudios_laboratorio ?? '' }}</p>
            </div>
        </div>
    </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- DIAGNÓSTICOS --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <p><strong>Diagnóstico</strong></p>
            </div>
            <div class="card-body">
                <p>{{ $valoracionInicial->paciente->diagnostico->nombre ?? '' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <p><strong>Diagnóstico CIE-10</strong></p>
            </div>
            <div class="card-body">
                <p>{{ $valoracionInicial->paciente->diagnosticoCie10->codigo ?? '' }} - {{ $valoracionInicial->paciente->diagnosticoCie10->descripcion ?? '' }}</p>
            </div>
        </div>
    </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- PRONOSTICO --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="card">
    <div class="card-header"><p><strong>Pronóstico</strong></p></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                
                <p>{{ $valoracionInicial->pronostico ?? '' }}</p>
            </div>
        </div>
    </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- ANALISIS --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="card">
    <div class="card-header"><p><strong>Análisis, Propuesta de Tratamiento e Indicaciones</strong></p></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                
                <p>{{ $valoracionInicial->analisis ?? '' }}</p>
            </div>
        </div>
    </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- MEDICO --}}
{{--------------------------------------------------------------------------------------------------------}}

<div class="card shadow-sm border-0 mt-3">
    <div class="card-body text-center">

        <h5 class="mb-3">
            <strong>Médico que realizó la valoración</strong>
        </h5>

        <div class="mb-2">
            <h4 class="mb-1">
                {{ $valoracionInicial->medico->nombre_completo ?? 'No asignado' }}
            </h4>
        </div>

        <div class="mb-2 text-muted">
            {{ $valoracionInicial->medico->especialidad->especialidad ?? 'Sin especialidad' }}
        </div>

        <div class="mt-2">
            <span class="badge bg-primary">
                Cédula: {{ $valoracionInicial->medico->cedula ?? 'N/A' }}
            </span>
        </div>

    </div>
</div>

{{--------------------------------------------------------------------------------------------------------}}
{{-- FIN --}}
{{--------------------------------------------------------------------------------------------------------}}

<br>

@include('partials.footer')

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