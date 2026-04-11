@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Central De Enfermería</strong> <small class="text-muted">Detalles de Toma de Signos Vitales</small></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        
    </div>

        <div class="card-body">

           
            <div class="row">

                <div class="col-md-2">
                    <p><strong>Peso (kg)</strong></p>
                    {{ $cita->peso }}
                </div>

                <div class="col-md-2">
                    <p><strong>Talla (cm)</strong></p>
                    {{ $cita->talla }}
                </div>

                <div class="col-md-2">
                <p><strong>IMC</strong></p>

                @php $imc = $cita->imc; @endphp

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
                $sis = $cita->sistolica;
                $dia = $cita->diastolica;
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
                $fc = $cita->cardiaca;
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
                $temp = $cita->temperatura;
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
                    $fr = $cita->respiratoria;
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
                $spo2 = $cita->saO2;
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
                $dolor = $cita->dolor;
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
                $caidas = $cita->caidas;
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

        <div class="col-md-2">
            <p><strong>Edad</strong></p>
            <p>{{ $cita->edad ?? 'Sin datos' }} años</p>
        </div>

            {{-------------------------}}
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <p><strong>Exploración Física</strong></p>
                    <p>{{ $cita->exploracion_fisica ?? '' }}</p>
                </div>
            </div>

        </div>

        <div class="card-footer">

            <div class="text-right mt-3">

                <a href="{{ route('centralEnfermeriaTomaSignosVitalesCreate', $cita->id) }}">
                
                <button type="submit" 
                    class="btn btn-success btn-sm d-inline-flex align-items-center" 
                    style="gap:6px; border-radius:6px;">

                    <x-lucide-user-round-pen style="width:16px; height:16px;"/>
                    ACTUALIZAR DATOS
                </button>

               </a>
                
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