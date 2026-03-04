@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Medicamentos</strong> <small class="text-muted">Código de Barras</small></h1>
@stop

@section('content')

    <!-- -->

    @php
        $alerts = ['store','update','destroy'];
    @endphp

    @foreach ($alerts as $alert)
        @if (session($alert))
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
        <div class="card-body">
            <ul>
                <li><strong>Medicamento : </strong> {{ $medicamento->nombre }}</li>
                <li><strong>Clave CABMS : </strong> {{ $medicamento->clave }}</li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Registrar Código de Barras</strong>
        </div>
        <div class="card-body">

            <form action="{{ route('storeCodigoDeBarras', $medicamento->id) }}" method="POST">

                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Código de Barras</strong></p>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}">

                        @error('codigo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-3">
                        <p><strong>Forma Farmacéutica</strong></p>
                        <input type="text" name="forma_farmaceutica" class="form-control" value="{{ old('forma_farmaceutica') }}">

                        @error('forma_farmaceutica')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-3">
                        <p><strong>Marca</strong></p>
                        <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">

                        @error('marca')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-3">
                        <p><strong>Fabricante</strong></p>
                        <input type="text" name="fabricante" class="form-control" value="{{ old('fabricante') }}">

                        @error('fabricante')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Presentación</strong></p>
                        <input type="text" name="presentacion" class="form-control" value="{{ old('presentacion') }}">

                        @error('presentacion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa-regular fa-circle-check"></i> REGISTRAR
            </button>
        </div>
        </form>
    </div>

    {{-- --------------------------------------------------------------------------------------- --}}

    <div class="card">
        <div class="card-header">
            <strong>Lista de Códigos de Barras</strong>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código de Barras</th>
                        <th>Forma Farmacéutica</th>
                        <th>Marca</th>
                        <th>Fabricante</th>
                        <th>Unidad</th>
                        <th>Presentación</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicamento->codigos as $index => $codigo)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $codigo->codigo }}</td>
                            <td>{{ $codigo->forma_farmaceutica }}</td>
                            <td>{{ $codigo->marca }}</td>
                            <td>{{ $codigo->fabricante }}</td>
                            <td>{{ $codigo->unidad_medida }}</td>
                            <td>{{ $codigo->presentacion }}</td>
                            <td>

                                <div class="d-flex flex-column" style="gap:6px;">

                                    <a href="{{ route('editCodigoDeBarras', $codigo->id) }}" 
                                    class="btn btn-warning btn-sm w-100 text-white">
                                        <i class="fa-regular fa-pen-to-square"></i> EDITAR
                                    </a>

                                    <form id="delete-form-{{ $codigo->id }}" 
                                        action="{{ route('destroyCodigoDeBarras', $codigo->id) }}" 
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" 
                                                class="btn btn-danger btn-sm w-100"
                                                onclick="confirmDelete({{ $codigo->id }})">
                                            <i class="fa-regular fa-trash-can"></i> ELIMINAR
                                        </button>
                                    </form>

                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No hay códigos asignados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-footer"></div>
    </div>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
