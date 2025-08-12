@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Proveedores</h1>
@stop

@section('content')

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Proveedores</li>
    </ol>

    <div class="card">
       
        <div class="card">
            <div class="card-header">
                @can('crear-proveedore')
                    <a href="{{ route('admin.proveedore.create') }}">
                        <button type="button" class="btn btn-primary">Agregar proveedor</button>
                    </a>
                @endcan
            </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="proveedores">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Documento</th>
                        <th>Tipo de persona</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedore)
                    <tr>
                        <td>
                            {{$proveedore->razon_social}}
                        </td>
                        <td>
                            {{$proveedore->direccion}}
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">{{$proveedore->documento->tipo_documento}}</p>
                            <p class="text-muted mb-0">{{$proveedore->numero_documento}}</p>
                        </td>
                        <td>
                            {{$proveedore->tipo_persona}}
                        </td>
                        <td>
                            @if ($proveedore->estado == 1)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Eliminado</span>
                            @endif
                        </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    @can('editar-proveedore')
                                        <a href="{{ route('admin.proveedore.edit', $proveedore->id) }}" class="btn btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan
                                    @can('eliminar-proveedore')
                                        @if ($proveedore->estado == 1)
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal-{{$proveedore->id}}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        @else
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmModal-{{$proveedore->id}}">
                                                <i class="fa-solid fa-arrows-rotate"></i>
                                            </button>
                                        @endif
                                    @endcan
                                   
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Confirm Modal -->
                        <div class="modal fade" id="confirmModal-{{$proveedore->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $proveedore->estado == 1 ? '¿Seguro que quieres eliminar el proveedor?' : '¿Seguro que quieres restaurar el proveedor?' }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('admin.proveedore.destroy',['proveedore'=>$proveedore->id]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
        $('#proveedores').DataTable();

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
@stop