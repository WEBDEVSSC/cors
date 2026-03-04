@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Medicamentos</strong> <small class="text-muted">Entradas</small></h1>
@stop

@section('content')

<!-- -->

@php
    $alerts = [
        'successMedicamento',
        'successCodigoDeBarras',
        'destroyMedicamento'
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
            
        </div>
        <div class="card-body">

            <form action="{{ route('storeEntradaMedicamento') }}" method="POST">

                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Medicamento</strong></p>
                        <select name="medicamento_id" class="form-control">
                            <option value="">Seleccione un medicamento</option>

                            @foreach($medicamentos as $medicamento)
                                <option value="{{ $medicamento->id }}"
                                    {{ old('medicamento_id') == $medicamento->id ? 'selected' : '' }}>
                                    {{ $medicamento->nombre }}
                                </option>
                            @endforeach

                        </select>

                        @error('medicamento_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="col-md-3">
                        <p><strong>Cantidad</strong></p>
                        <input type="text" name="cantidad" class="form-control" value="{{ old('cantidad')}}">

                        @error('cantidad')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Fecha de caducidad</strong></p>
                        <input type="date" name="fecha_caducidad" class="form-control" value="{{ old('fecha_caducidad')}}">

                        @error('fecha_caducidad')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Concepto</strong></p>
                        <select name="concepto" class="form-control">
                            <option value="">Seleccione un concepto</option>

                            @foreach($farmaciaConceptos as $concepto)
                                <option value="{{ $concepto->id }}"
                                    {{ old('concepto') == $concepto->id ? 'selected' : '' }}>
                                    {{ $concepto->concepto }}
                                </option>
                            @endforeach
                        </select>

                        @error('concepto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Requisición</strong></p>
                        <input type="text" name="requisicion" class="form-control" value="{{ old('requisicion')}}">

                        @error('requisicion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Lote</strong></p>
                        <input type="text" name="lote" class="form-control" value="{{ old('lote')}}">

                        @error('lote')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa-regular fa-circle-check"></i> REGISTRAR DATOS
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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