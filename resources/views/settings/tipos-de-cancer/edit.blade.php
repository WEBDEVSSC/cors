@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Tipos de Cancer</strong> <small>Editar Registro</small></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('tiposDeCancerIndex') }}" class="btn btn-info btn-sm float-right">
                <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL</a>
        </div>
        <div class="card-body">

            <form action="{{ route('tiposDeCancerUpdate', $tipoDeCancer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre',$tipoDeCancer->nombre) }}">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            

        </div>
        <div class="card-footer">
                <button type="submit" class="btn btn-success btn-sm float-right">
                    <i class="fa-solid fa-check"></i> REGISTRAR DATOS</button>
                </form>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop