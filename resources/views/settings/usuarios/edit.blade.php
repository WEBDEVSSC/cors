@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Usuarios</strong> <small class="text-muted">Nuevo Registro</small></h1>
@stop

@section('content')


<div class="card">
    <div class="card-header">
        <a href="{{ route('usuariosIndex') }}" class="btn btn-info btn-sm float-right">
            <i class="fa-solid fa-sliders"></i> PANEL DE CONTROL
        </a>
    </div>

    <form action="{{ route('usuariosUpdate', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- DATOS GENERALES --}}
            <div class="row">
                <div class="col-md-3">
                    <label>Nombre</label>
                    <input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $usuario->name) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>E-mail</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $usuario->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>Contraseña</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label>Rol</label>
                    <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="">-- Selecciona una opción --</option>                        
                        <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Admin</option>                        
                        <option value="farmacia" {{ old('role', $usuario->role) == 'farmacia' ? 'selected' : '' }}>Farmacia</option>                        
                        <option value="recepcion" {{ old('role', $usuario->role) == 'recepcion' ? 'selected' : '' }}>Recepción</option>
                        <option value="consultaExternaMedico" {{ old('role', $usuario->role) == 'consultaExternaMedico' ? 'selected' : '' }}>Consulta Externa Médico</option>
                        <option value="consultaExternaEnfermeria" {{ old('role', $usuario->role) == 'consultaExternaEnfermeria' ? 'selected' : '' }}>Consulta Externa Enfermería</option>
                    </select>

                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                   
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm float-right">
                <i class="fa-solid fa-check"></i> REGISTRAR DATOS
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