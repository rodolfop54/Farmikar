@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Bienvenid@ {{ Auth::user()->name }}</h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <?php
                        use App\Models\Categoria;
                        $categorias = count(Categoria::all());
                    ?>
                    <h3>{{$categorias}}</h3>
                    <p>Categorias</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                @can('ver-categoria')
                    <a href="{{route('admin.categoria.index')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <?php
                        use App\Models\Producto;
                        $productos = count(Producto::all());
                    ?>
                    <h3>{{$productos}}</h3>
                    <p>Productos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                @can('ver-producto')
                    <a href="{{route('admin.producto.index')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <?php
                        use App\Models\User;
                        $users = count(User::all());
                    ?>
                    <h3>{{$users}}</h3>
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                @can('ver-user')
                    <a href="{{route('admin.user.index')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <?php
                        use App\Models\Cliente;
                        $clientes = count(Cliente::all());
                    ?>
                    <h3>{{$clientes}}</h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                @can('ver-cliente')
                    <a href="{{route('admin.cliente.index')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- Incluir SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         // Esto detecta si se acaba de iniciar sesión
            /* Swal.fire({
                title: '¡Bienvenido/a, {{ Auth::user()->name }}!',
                text: 'Nos alegra verte de nuevo.',
                imageUrl: '{{ Auth::user()->profile_photo_url }}',  // Imagen de perfil del usuario
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'Imagen de perfil',
                icon: 'success',
                confirmButtonText: 'Gracias'
            }); */
       
    </script>

    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
