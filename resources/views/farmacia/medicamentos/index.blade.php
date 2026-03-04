@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Medicamentos</strong></h1>
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
            <strong>Nuevo registro</strong>
        </div>
        <div class="card-body">

            <form action="{{ route('storeMedicamento') }}" method="POST">

                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Clave CABMS</strong></p>
                        <input type="text" name="clave" class="form-control" value="{{ old('clave')}}">

                        @error('clave')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <p><strong>Nombre</strong></p>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre')}}">

                        @error('nombre')
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

    <div class="card">
        <div class="card-header">
            <strong>Lista de registros</strong>
        </div>
        <div class="card-body">

            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Código de Barras</th>
                        <th width="150px"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($medicamentos as $medicamento)
                        <tr>
                            <td>{{ $medicamento->id }}</td>
                            <td>{{ $medicamento->clave }}</td>
                            <td>{{ $medicamento->nombre }}</td>
                            <td>
                                @if($medicamento->codigos->count())
                                    <ul>
                                        @foreach($medicamento->codigos as $codigo)
                                            <li>{{ $codigo->codigo }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">Sin códigos</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column" style="gap:6px;">

                                    <a href="{{ route('createCodigoDeBarras',$medicamento->id) }}" 
                                    class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-barcode"></i> CÓDIGOS DE BARRAS
                                    </a>

                                    <a href="{{ route('editMedicamento',$medicamento->id) }}" 
                                    class="btn btn-success btn-sm">
                                        <i class="fa-regular fa-pen-to-square"></i> EDITAR DATOS
                                    </a>

                                    <form id="delete-form-{{ $medicamento->id }}" 
                                        action="{{ route('destroyMedicamento', $medicamento->id) }}" 
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="btn btn-danger btn-sm w-100"
                                                onclick="confirmDelete({{ $medicamento->id }})">
                                            <i class="fa-regular fa-trash-can"></i> ELIMINAR DATOS
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay medicamentos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-footer"></div>
    </div>

    <br>
    
@stop

@include('partials.footer')

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

    <script>
    $(function () {
        $('#table').DataTable({
            language: {
                sProcessing:     "Procesando...",
                sLengthMenu:     "Mostrar _MENU_ registros",
                sZeroRecords:    "No se encontraron resultados",
                sEmptyTable:     "Ningún dato disponible en esta tabla",
                sInfo:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                sInfoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
                sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
                sSearch:         "Buscar:",
                oPaginate: {
                    sFirst:    "Primero",
                    sLast:     "Último",
                    sNext:     "Siguiente",
                    sPrevious: "Anterior"
                }
            }
        });
    });
    </script>
@stop