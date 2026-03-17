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
                    This is some text within a card body.
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
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