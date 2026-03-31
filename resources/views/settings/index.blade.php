@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Settings</strong></h1>
@stop

@section('content')
    
    <div class="row">
        
        <div class="col-md-2">
            <a href="{{ route('tiposDeCancerIndex') }}">
            <div class="card">
                <div class="card-body text-center">
                           
                    <x-lucide-square-activity style="width:60px; height:60px;" />

                </div>
                <div class="card-footer"><center><strong>Tipos de Cancer</strong></center></div>
            </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('especialidadesMedicasIndex') }}">
            <div class="card">
                <div class="card-body text-center">
                    
                        <x-lucide-briefcase-medical style="width:60px; height:60px;" />
                    
                </div>
                <div class="card-footer"><center><strong>Especialidades Médicas</strong></center></div>
            </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('medicosIndex') }}">
            <div class="card">
                <div class="card-body text-center">
                    
                        <x-lucide-stethoscope style="width:60px; height:60px;" />
                    
                </div>
                <div class="card-footer"><center><strong>Médicos</strong></center></div>
            </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('afiliacionesIndex') }}">
            <div class="card">
                <div class="card-body text-center">
                    
                        <x-lucide-folder-archive style="width:60px; height:60px;" />
                    
                </div>
                <div class="card-footer"><center><strong>Afiliaciones</strong></center></div>
            </div>
            </a>
        </div>

        <div class="col-md-2">
            <a href="{{ route('usuariosIndex') }}">
            <div class="card">
                <div class="card-body text-center">
                    
                        <x-lucide-shield-user style="width:60px; height:60px;" />
                    
                </div>
                <div class="card-footer"><center><strong>Usuarios</strong></center></div>
            </div>
            </a>
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