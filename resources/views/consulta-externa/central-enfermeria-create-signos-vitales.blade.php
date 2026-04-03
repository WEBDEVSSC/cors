@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Central De Enfermería</strong> <small class="text-muted">Toma de Signos Vitales</small></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        
    </div>

    <form action="{{ route('centralEnfermeriaTomaSignosVitalesUpdate', $cita->id) }}" method="POST">
        @csrf
        
        @method('PUT')

        <div class="card-body">

            {{-- DATOS GENERALES --}}
            <div class="row">

                <div class="col-md-2">
                    <label for="peso">Peso (kg)</label>
                    <input type="text" id="peso" name="peso" class="form-control @error('peso') is-invalid @enderror" value="{{ old('peso', $cita->peso) }}">
                    @error('peso')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="talla">Talla (cms)</label>
                    <input type="text" id="talla" class="form-control @error('talla') is-invalid @enderror" name="talla" value="{{ old('talla', $cita->talla) }}">
                    @error('talla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="sistolica">Presión Arterial Sistolica (mmHg)</label>
                    <input type="text" id="sistolica" class="form-control @error('sistolica') is-invalid @enderror"
                        name="sistolica" value="{{ old('sistolica', $cita->sistolica) }}">
                    @error('sistolica')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="diastolica">Presión Arterial Diastólica (mmHg)</label>
                    <input type="text" id="diastolica" class="form-control @error('diastolica') is-invalid @enderror" name="diastolica" value="{{ old('diastolica', $cita->diastolica) }}">
                    @error('diastolica')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="cardiaca">Frecuencia Cardíaca (lpm)</label>
                    <input type="text" id="cardiaca" name="cardiaca" class="form-control @error('cardiaca') is-invalid @enderror" value="{{ old('cardiaca', $cita->cardiaca) }}">
                    @error('cardiaca')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="respiratoria">Frecuencia Respiratoria (rpm)</label>
                    <input type="text" id="respiratoria" name="respiratoria" class="form-control @error('respiratoria') is-invalid @enderror" value="{{ old('respiratoria', $cita->respiratoria) }}">
                    @error('respiratoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- CONTACTO --}}
            <div class="row mt-3">
                

                <div class="col-md-2">
                    <label for="temperatura">Temperatura (°C)</label>
                    <input type="text" id="temperatura" class="form-control @error('temperatura') is-invalid @enderror" name="temperatura" value="{{ old('temperatura', $cita->temperatura) }}">
                    @error('temperatura')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="saO2">Saturación de oxígeno (SpO₂ %)</label>
                    <input type="text" id="saO2" class="form-control @error('saO2') is-invalid @enderror" name="saO2" value="{{ old('saO2', $cita->saO2) }}">
                    @error('saO2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="dolor">Dolor (0–10)</label>
                    <select name="dolor" class="form-control">
                        <option value="">-- Seleccione una opción --</option>

                        <optgroup label="Sin dolor">
                            <option value="0" {{ old('dolor', $cita->dolor) == 0 ? 'selected' : '' }}>0 - Sin dolor</option>
                        </optgroup>

                        <optgroup label="Dolor leve">
                            <option value="1" {{ old('dolor', $cita->dolor) == 1 ? 'selected' : '' }}>1 - Muy leve</option>
                            <option value="2" {{ old('dolor', $cita->dolor) == 2 ? 'selected' : '' }}>2 - Leve</option>
                            <option value="3" {{ old('dolor', $cita->dolor) == 3 ? 'selected' : '' }}>3 - Leve a moderado</option>
                        </optgroup>

                        <optgroup label="Dolor moderado">
                            <option value="4" {{ old('dolor', $cita->dolor) == 4 ? 'selected' : '' }}>4 - Moderado</option>
                            <option value="5" {{ old('dolor', $cita->dolor) == 5 ? 'selected' : '' }}>5 - Moderado a intenso</option>
                        </optgroup>

                        <optgroup label="Dolor intenso">
                            <option value="6" {{ old('dolor', $cita->dolor) == 6 ? 'selected' : '' }}>6 - Intenso</option>
                            <option value="7" {{ old('dolor', $cita->dolor) == 7 ? 'selected' : '' }}>7 - Muy intenso</option>
                            <option value="8" {{ old('dolor', $cita->dolor) == 8 ? 'selected' : '' }}>8 - Severo</option>
                            <option value="9" {{ old('dolor', $cita->dolor) == 9 ? 'selected' : '' }}>9 - Muy severo</option>
                            <option value="10" {{ old('dolor', $cita->dolor) == 10 ? 'selected' : '' }}>10 - Insoportable</option>
                        </optgroup>
                    </select>

                    @error('dolor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="caidas">¿Ha presentado caídas?</label>
                    <select name="caidas" class="form-control">
                        <option value="">-- Seleccione una opción --</option>

                        <option value="0" {{ old('caidas', $cita->caidas) == 0 ? 'selected' : '' }}>
                            No (sin riesgo aparente)
                        </option>
                        <option value="1" {{ old('caidas', $cita->caidas) == 1 ? 'selected' : '' }}>
                            Sí (riesgo o antecedente de caída)
                        </option>
                    </select>

                    @error('caidas')
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