@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Pacientes</strong> <small class="text-muted">Editar Registro</small></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('pacientesIndex') }}" class="btn btn-info btn-sm float-right">
            <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL
        </a>
    </div>

    <form action="{{ route('pacientesUpdate', $paciente->id) }}" method="POST">
        @csrf

        @method('PUT')

        <div class="card-body">

            {{-- DATOS GENERALES --}}
            <div class="row">

                <div class="col-md-3">
                    <label for="curp">CURP</label>
                    <input type="text" id="curp" name="curp" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp',$paciente->curp) }}" readonly>
                    @error('curp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$paciente->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" id="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror" name="apellido_paterno" value="{{ old('apellido_paterno',$paciente->apellido_paterno) }}">
                    @error('apellido_paterno')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" id="apellido_materno" class="form-control @error('apellido_materno') is-invalid @enderror" name="apellido_materno" value="{{ old('apellido_materno',$paciente->apellido_materno) }}">
                    @error('apellido_materno')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- CONTACTO --}}
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento',$paciente->fecha_nacimiento) }}" readonly>
                    @error('fecha_nacimiento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="sexo">Sexo</label>
                    <input type="text" id="sexo" name="sexo" class="form-control @error('sexo') is-invalid @enderror" value="{{ old('sexo', $paciente->sexo) }}" readonly>
                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="email">Correo</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email',$paciente->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" class="form-control @error('telefono') is-invalid @enderror"
                        name="telefono" value="{{ old('telefono',$paciente->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="residencia">Residencia</label>
                    <input type="text" id="residencia" class="form-control @error('residencia') is-invalid @enderror" name="residencia" value="{{ old('residencia',$paciente->residencia) }}">
                    @error('residencia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="ocupacion">Ocupación</label>
                    <input type="text" id="ocupacion" class="form-control @error('ocupacion') is-invalid @enderror" name="ocupacion" value="{{ old('ocupacion',$paciente->ocupacion) }}">
                    @error('ocupacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="estado_civil">Estado Civil</label>

                    <select id="estado_civil" name="estado_civil" class="form-control @error('estado_civil') is-invalid @enderror">
                        <option value="">-- Selecciona una opción --</option>

                        <option value="SOLTERO" {{ old('estado_civil',$paciente->estado_civil) == 'SOLTERO' ? 'selected' : '' }}>SOLTERO</option>
                        <option value="CASADO" {{ old('estado_civil',$paciente->estado_civil) == 'CASADO' ? 'selected' : '' }}>CASADO</option>
                        <option value="DIVORCIADO" {{ old('estado_civil',$paciente->estado_civil) == 'DIVORCIADO' ? 'selected' : '' }}>DIVORCIADO</option>
                        <option value="VIUDO" {{ old('estado_civil',$paciente->estado_civil) == 'VIUDO' ? 'selected' : '' }}>VIUDO</option>
                        <option value="CONCUBINATO" {{ old('estado_civil',$paciente->estado_civil) == 'CONCUBINATO' ? 'selected' : '' }}>CONCUBINATO</option>
                        <option value="UNION LIBRE" {{ old('estado_civil',$paciente->estado_civil) == 'UNION LIBRE' ? 'selected' : '' }}>UNIÓN LIBRE</option>
                        <option value="SEPARADO" {{ old('estado_civil',$paciente->estado_civil) == 'SEPARADO' ? 'selected' : '' }}>SEPARADO</option>
                    </select>

                    @error('estado_civil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="afiliacion_id">Afiliación</label>

                    <select id="afiliacion_id" name="afiliacion_id" class="form-control @error('afiliacion_id') is-invalid @enderror">
                        <option value="">-- Selecciona una opción --</option>

                        @foreach($afiliaciones as $afiliacion)
                            <option value="{{ $afiliacion->id }}"
                                {{ old('afiliacion_id',$paciente->afiliacion_id) == $afiliacion->id ? 'selected' : '' }}>
                                
                                {{ $afiliacion->afiliacion }}
                            </option>
                        @endforeach
                    </select>

                    @error('afiliacion_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

            </div>

            <div class="row mt-3">

                <div class="col-md-3">
                    <label for="primera_vez">¿Primera vez?</label>

                    <select id="primera_vez" name="primera_vez" class="form-control @error('primera_vez') is-invalid @enderror">
                        <option value="">-- Selecciona una opción --</option>

                        <option value="SI" {{ old('primera_vez',$paciente->primera_vez) == 'SI' ? 'selected' : '' }}>SI</option>
                        <option value="NO" {{ old('primera_vez',$paciente->primera_vez) == 'NO' ? 'selected' : '' }}>NO</option>
                    </select>

                    @error('primera_vez')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="diagnostico_id">Diagnóstico</label>

                    <select name="diagnostico_id" id="diagnostico_id" class="form-control @error('diagnostico_id') is-invalid @enderror">
                        <option value="">-- Selecciona una opción --</option>

                        @foreach($tiposDeCancer as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ old('diagnostico_id',$paciente->diagnostico_id) == $tipo->id ? 'selected' : '' }}>
                                
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('diagnostico_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="cirujano_oncologo_id">Cirujano Oncólogo</label>

                    <select name="cirujano_oncologo_id" id="cirujano_oncologo_id" class="form-control @error('cirujano_oncologo_id') is-invalid @enderror">
                        <option value="">-- Selecciona una opción --</option>

                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}"
                                {{ old('cirujano_oncologo_id',$paciente->cirujano_oncologo) == $medico->id ? 'selected' : '' }}>
                                
                                {{ $medico->nombre_completo }}
                            </option>
                        @endforeach
                    </select>

                    @error('cirujano_oncologo_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="oncologo_medico_id">Oncólogo Médico</label>

                    <select name="oncologo_medico_id" id="oncologo_medico_id" class="form-control @error('oncologo_medico_id') is-invalid @enderror">
                        <option value="">-- Selecciona una opción --</option>

                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}"
                                {{ old('oncologo_medico_id',$paciente->oncologo_medico) == $medico->id ? 'selected' : '' }}>
                                
                                {{ $medico->nombre_completo }}
                            </option>
                        @endforeach
                    </select>

                    @error('oncologo_medico_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="alergias">Alergias</label>

                    <textarea name="alergias" id="alergias" rows="4" class="form-control @error('alergias') is-invalid @enderror" >{{ old('alergias',$paciente->alergias) }}</textarea>

                    @error('alergias')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>         

        </div>

        <div class="card-footer">

            <div class="text-right mt-3">
                
                <button type="submit" 
                    class="btn btn-success btn-sm d-inline-flex align-items-center" 
                    style="gap:6px; border-radius:6px;">

                    <x-lucide-save style="width:16px; height:16px;"/>
                    REGISTRAR DATOS
                </button>
                
            </div>
        </div>
    </form>
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