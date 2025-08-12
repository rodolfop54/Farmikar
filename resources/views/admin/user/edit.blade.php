@extends('adminlte::page')

@section('title', 'Editar usuario')

@section('content_header')
    <h1>Crear usuario</h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Clientes</a></li>
    <li class="breadcrumb-item active">Editar usuario</li>
</ol>
<div class="card">
    <form action="{{ route('admin.user.update',['user' => $user]) }}" method="post">
        @method('PATCH')
        @csrf
        <div class="card-header">
            <p class="">Nota: Los usuarios son los que pueden ingresar al sistema</p>
        </div>
        <div class="card-body">
            <!---Nombre---->
            <div class="row mb-4">
                <label for="name" class="col-lg-2 col-form-label">Nombres:</label>
                <div class="col-lg-4">
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name',$user->name)}}">
                </div>
                <div class="col-lg-4">
                    <div class="form-text">
                        Actualice su nombre
                    </div>
                </div>
                <div class="col-lg-2">
                    @error('name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>

            <!---Email---->
            <div class="row mb-4">
                <label for="email" class="col-lg-2 col-form-label">Email:</label>
                <div class="col-lg-4">
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email',$user->email)}}">
                </div>
                <div class="col-lg-4">
                    <div class="form-text">
                        Actualice su correo
                    </div>
                </div>
                <div class="col-lg-2">
                    @error('email')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>

            <!---Password---->
            <div class="row mb-4">
                <label for="password" class="col-lg-2 col-form-label">Contraseña:</label>
                <div class="col-lg-4">
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="col-lg-4">
                    <div class="form-text">
                        Escriba una constraseña segura. Debe incluir números.
                    </div>
                </div>
                <div class="col-lg-2">
                    @error('password')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>

            <!---Confirm_Password---->
            <div class="row mb-4">
                <label for="password_confirm" class="col-lg-2 col-form-label">Confirmar:</label>
                <div class="col-lg-4">
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                </div>
                <div class="col-lg-4">
                    <div class="form-text">
                        Vuelva a escribir su contraseña.
                    </div>
                </div>
                <div class="col-lg-2">
                    @error('password_confirm')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>

            <!---Roles---->
            <div class="row mb-4">
                <label for="role" class="col-lg-2 col-form-label">Seleccionar rol:</label>
                <div class="col-lg-4">
                    <select name="role" id="role" class="form-control">
                        @foreach ($roles as $item)
                        @if ( in_array($item->name,$user->roles->pluck('name')->toArray()) )
                        <option selected value="{{$item->name}}" @selected(old('role')==$item->name)>{{$item->name}}</option>
                        @else
                        <option value="{{$item->name}}" @selected(old('role')==$item->name)>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <div class="form-text">
                        Escoja un rol para el usuario.
                    </div>
                </div>
                <div class="col-lg-2">
                    @error('role')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
