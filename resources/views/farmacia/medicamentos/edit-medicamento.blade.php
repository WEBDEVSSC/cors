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
        'updateMedicamento',
        'successCodigoDeBarras',
        'updateCodigoDeBarras',
        'destroyCodigoDeBarras'
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

            <form action="{{ route('updateMedicamento', $medicamento->id) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <strong>Clave CABMS</strong>
                        <input type="text" name="clave" class="form-control" value="{{ old('clave',$medicamento->clave)}}">

                        @error('clave')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <strong>Nombre</strong>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre',$medicamento->nombre)}}">

                        @error('nombre')
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

    <!-- -->

    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
    </script>
@stop