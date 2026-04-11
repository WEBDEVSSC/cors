@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Usuarios</strong> <small class="text-muted">Asignar Médico</small></h1>
@stop

@section('content')


<div class="card">
    <div class="card-header">
        <p><strong>Usuario : </strong>{{ $usuario->name }}</p>
        <a href="{{ route('usuariosIndex') }}" 
                class="btn btn-sm btn-info mr-1 float-right" 
                data-toggle="tooltip" 
                title="PANEL DE CONTROL">

                <x-lucide-layout-panel-left style="width:16px; height:16px;" class="text-white"/>
                PANEL DE CONTROL
                
        </a>
    </div>

    

    <form action="{{ route('usuariosMedicoUpdate', $usuario->id) }}" method="POST">
        @csrf

        @method('PUT')

        <div class="card-body">

            {{-- DATOS GENERALES --}}
            <div class="row">
                <div class="col-md-3">
                    <label>Médico</label>
                    
                    <select name="medico_id" 
                            class="form-control @error('medico_id') is-invalid @enderror">

                        <option value="">-- Selecciona una opción --</option>

                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}"
                                {{ old('medico_id') == $medico->id ? 'selected' : '' }}>
                                {{ $medico->nombre_completo }}
                            </option>
                        @endforeach

                    </select>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

        </div>

        <div class="card-footer">
            <button type="submit" 
                    class="btn btn-success btn-sm float-right d-inline-flex align-items-center" 
                    style="gap:6px;">

                <x-lucide-save style="width:16px; height:16px;" />
                REGISTRAR DATOS

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

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Este registro se eliminará",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop