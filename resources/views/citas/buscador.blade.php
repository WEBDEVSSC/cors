@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Citas</strong></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Agendar</strong>
        </div>
        <form action="{{ route('mostrarHorariosDisponibles') }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="paciente">Paciente</label>                        
                        <select name="paciente_id" class="form-control select2 @error('paciente_id') is-invalid @enderror" style="width: 100%;">
                            
                            <option value="">-- Selecciona una opción --</option>
                            
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}"
                                    {{ old('paciente_id', $registro->paciente_id ?? '') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre_completo }}
                                </option>
                            @endforeach
                        </select>

                        @error('paciente_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="medico_id">Medico</label>
                        
                        <select name="medico_id" 
                            class="form-control @error('medico_id') is-invalid @enderror">
                            
                            <option value="">-- Selecciona una opción --</option>
                            
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}"
                                    {{ old('medico_id', $registro->medico_id ?? '') == $medico->id ? 'selected' : '' }}>
                                    {{ $medico->nombre_completo }}
                                </option>
                            @endforeach
                        </select>

                        @error('medico_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="fecha">Fecha</label>
                        
                        <input 
                            type="date" 
                            name="fecha" 
                            value="{{ old('fecha') }}"
                            class="form-control @error('fecha') is-invalid @enderror"
                        >

                        @error('fecha')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <div class="text-right mt-3">
                    <button type="submit" 
                        class="btn btn-success btn-sm d-inline-flex align-items-center" 
                        style="gap:6px; border-radius:6px;">

                        <x-lucide-calendar-search style="width:16px; height:16px;"/>
                        BUSCAR HORARIO
                    </button>
                </div>
            </div>
        </form>


    </div>

    {{---------------------------------------------------------------------------------------------------}}

    <div class="card">
        <div class="card-header">
            <strong>Agenda de Citas por Médico</strong>
        </div>
        <div class="card-body">

            <form action="{{ route('medicoAgendaCita') }}" method="POST">
                
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <label for="medico_id">Medico</label>
                        
                        <select name="medico_id" class="form-control @error('medico_id') is-invalid @enderror">
                            
                            <option value="">-- Selecciona una opción --</option>
                            
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}"
                                    {{ old('medico_id', $registro->medico_id ?? '') == $medico->id ? 'selected' : '' }}>
                                    {{ $medico->nombre_completo }}
                                </option>
                            @endforeach
                        </select>

                        @error('medico_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="fecha">Fecha</label>
                        
                        <input type="date" name="fecha" value="{{ old('fecha') }}" class="form-control @error('fecha') is-invalid @enderror" >

                        @error('fecha')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="card-footer">
                <div class="text-right mt-3">
                    <button type="submit" 
                        class="btn btn-success btn-sm d-inline-flex align-items-center" 
                        style="gap:6px; border-radius:6px;">

                        <x-lucide-calendar-range style="width:16px; height:16px;"/>
                        MOSTRAR AGENDA
                    </button>
                </div>
            </div>

        </form>
    </div>

    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        /* Asegura que Select2 tenga el mismo alto y bordes redondeados */
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px) !important; /* Ajuste de altura */
            border-radius: 0.25rem !important; /* Bordes redondeados */
            border: 1px solid #ced4da !important; /* Color del borde */
        }
        
        /* Alineación del texto */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: calc(2.25rem - 2px) !important;
            padding-left: 0.75rem !important;
        }
        
        /* Ajuste del ícono desplegable */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px) !important;
        }
    </style>

@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                allowClear: true
            });
        });
    </script>

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