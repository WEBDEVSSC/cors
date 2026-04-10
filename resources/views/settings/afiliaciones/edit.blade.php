@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Afiliaciones</strong> <small class="text-muted">Editar Registro</small></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('afiliacionesIndex') }}" class="btn btn-info btn-sm float-right">
            <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL
        </a>
    </div>

    <form action="{{ route('afiliacionesUpdate', $afiliacion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- DATOS GENERALES --}}
            <div class="row">
                <div class="col-md-3">
                    <label>Afiliación</label>
                    <input type="text" class="form-control @error('afiliacion', $afiliacion->afiliacion) is-invalid @enderror"
                        name="afiliacion" value="{{ old('afiliacion', $afiliacion->afiliacion) }}">
                    @error('afiliacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
@stop