@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
        @can('crear-user')
            <a class="btn btn-primary" href="{{route('admin.user.create')}}">Agregar usuario</a>
        @endcan
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="users">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles->pluck('name')->implode(', ')}}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                @can('editar-user')
                                <a class="btn btn-warning"href="{{route('admin.user.edit',['user'=>$user])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                @endcan
                                @can('eliminar-user')
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal-{{$user->id}}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                @endcan
                                
                            </div>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap4.css">
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        $(document).ready(function() {
        $('#users').DataTable();

        // Show success message
        @if (session('success'))
            let message = "{{session('success')}}";
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        @endif
    });
</script>
@endsection