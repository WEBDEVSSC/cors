@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Médicos</strong> <small class="text-muted">Nuevo Registro</small></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('medicosIndex') }}" class="btn btn-info btn-sm float-right">
            <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL
        </a>
    </div>

    <form action="{{ route('medicosStore') }}" method="POST">
        @csrf

        <div class="card-body">

            {{-- DATOS GENERALES --}}
            <div class="row">
                <div class="col-md-3">
                    <label>Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                        name="nombre" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>Apellido Paterno</label>
                    <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror"
                        name="apellido_paterno" value="{{ old('apellido_paterno') }}">
                    @error('apellido_paterno')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>Apellido Materno</label>
                    <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror"
                        name="apellido_materno" value="{{ old('apellido_materno') }}">
                    @error('apellido_materno')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>Cédula</label>
                    <input type="text" class="form-control @error('cedula') is-invalid @enderror"
                        name="cedula" value="{{ old('cedula') }}">
                    @error('cedula')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- CONTACTO --}}
            <div class="row mt-3">
                <div class="col-md-3">
                    <label>Correo</label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror"
                        name="correo" value="{{ old('correo') }}">
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>Celular</label>
                    <input type="text" class="form-control @error('celular') is-invalid @enderror"
                        name="celular" value="{{ old('celular') }}">
                    @error('celular')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>Especialidad</label>
                    <select name="especialidad" class="form-control @error('especialidad') is-invalid @enderror">
                        <option value="">-- Seleccione una opción --</option>

                        @foreach($especialidadesMedicas as $especialidad)
                            <option value="{{ $especialidad->id }}"
                                {{ old('especialidad', $medico->especialidad_id ?? '') == $especialidad->id ? 'selected' : '' }}>
                                {{ $especialidad->especialidad }}
                            </option>
                        @endforeach
                    </select>

                    @error('especialidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- HORARIO --}}
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5><strong>Horario de Trabajo</strong></h5>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <table class="table table-bordered text-center">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>Día</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $dias = ['lunes','martes','miercoles','jueves','viernes'];
                            @endphp

                            @foreach($dias as $dia)
                            <tr>
                                <td><strong>{{ ucfirst($dia) }}</strong></td>
                                <td>
                                    <input type="time"
                                        class="form-control @error('entrada_'.$dia) is-invalid @enderror"
                                        name="entrada_{{ $dia }}"
                                        value="{{ old('entrada_'.$dia) }}">
                                </td>
                                <td>
                                    <input type="time"
                                        class="form-control @error('salida_'.$dia) is-invalid @enderror"
                                        name="salida_{{ $dia }}"
                                        value="{{ old('salida_'.$dia) }}">
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm float-right">
                <i class="fa-solid fa-check"></i> REGISTRAR DATOS
            </button>
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