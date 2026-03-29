@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Settings</strong></h1>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('tiposDeCancerIndex') }}">
                        <center><strong>Tipos de Cancer</strong></center>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('especialidadesMedicasIndex') }}">
                        <center><strong>Especialidades Médicas</strong></center>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('medicosIndex') }}">
                        <center><strong>Médicos</strong></center>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('afiliacionesIndex') }}">
                        <center><strong>Afiliaciones</strong></center>
                    </a>
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
@stop