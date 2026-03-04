@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Medicamento</strong></h1>
@stop

@section('content')

<!-- -->

@php
    $alerts = [
        'updateCodigoDeBarras',
    ];
@endphp

@foreach ($alerts as $alert)
    @if(session($alert))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Éxito',
                    text: "{{ session($alert) }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            });
        </script>
    @endif
@endforeach

<!-- -->

    <div class="card">
        <div class="card-header">
            <strong>Edición de registro</strong>
        </div>
        <div class="card-body">

            <form action="{{ route('updateCodigoDeBarras', $codigoDeBarras->id) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Código de Barras</strong></p>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $codigoDeBarras->codigo) }}">

                        @error('codigo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-3">
                        <p><strong>Forma Farmacéutica</strong></p>
                        <input type="text" name="forma_farmaceutica" class="form-control" value="{{ old('forma_farmaceutica', $codigoDeBarras->forma_farmaceutica) }}">

                        @error('forma_farmaceutica')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-3">
                        <p><strong>Marca</strong></p>
                        <input type="text" name="marca" class="form-control" value="{{ old('marca', $codigoDeBarras->marca) }}">

                        @error('marca')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-3">
                        <p><strong>Fabricante</strong></p>
                        <input type="text" name="fabricante" class="form-control" value="{{ old('fabricante', $codigoDeBarras->fabricante) }}">

                        @error('fabricante')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Presentación</strong></p>
                        <input type="text" name="presentacion" class="form-control" value="{{ old('presentacion', $codigoDeBarras->presentacion) }}">

                        @error('presentacion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">ACTUALIZAR DATOS</button>
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
@stop