@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Pacientes</strong></h1>
@stop

@section('content')

    <div class="card">
        <form action="{{ route('buscarPaciente') }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Ingresar la CURP</strong></p>
                        <input type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" value="{{ old('curp') }}">
                        
                        @error('curp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-success btn-sm">
                        BUSCAR DATOS
                    </button>
                </div>
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

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: '{{ session('warning') }}'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Información',
                text: '{{ session('info') }}'
            });
        @endif
    </script>
@stop