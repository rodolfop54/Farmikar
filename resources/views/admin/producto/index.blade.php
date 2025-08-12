@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    <div class="card card-outline card-primary">
        <div class="card-header">
            @can('crear-producto')
                <a href="{{ route('admin.producto.create') }}">
                    <button type="button" class="btn btn-primary">Agregar producto</button>
                </a>
            @endcan
        </div>
        <div class="card-body">

            <table class="table table-striped table-bordered" id="productos">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>Código</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Presentación</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td>
                            {{ $producto->codigo }}
                        </td>
                        <td class="text-center">
                            @if($producto->img_path)
                                <img src="{{ asset('storage/' . $producto->img_path) }}" alt="{{ $producto->nombre }}" style="max-width: 60px; max-height: 60px;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            {{ $producto->nombre }}
                        </td>
                        <td>
                            {{ $producto->marca->caracteristica->nombre }}
                        </td>
                        <td>
                            {{ $producto->presentacione->caracteristica->nombre }}
                        </td>
                        <td>
                            {{ $producto->categoria->caracteristica->nombre }}
                        </td>
                        <td class="text-center">
                            @if ($producto->estado == 1)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Eliminado</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                @can('ver-producto')
                                     <!-- Botón para ver detalles del producto -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailsModal-{{ $producto->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                @endcan
                                @can('editar-producto')
                                    <!-- Botón para editar el producto -->
                                    <a href="{{ route('admin.producto.edit', $producto->id) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endcan
                                
                                @can('eliminar-producto')
                                    <!-- Botón para eliminar/restaurar -->
                                    @if ($producto->estado == 1)
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal-{{ $producto->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @else
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmModal-{{ $producto->id }}">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </button>
                                @endif
                                @endcan
                                
                            </div>
                        </td>
                    </tr>

                    <!-- Modal para mostrar detalles del producto -->
                    <div class="modal fade" id="detailsModal-{{ $producto->id }}" tabindex="-1" aria-labelledby="detailsModalLabel-{{ $producto->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" id="detailsModalLabel-{{ $producto->id }}">Detalles del Producto</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Código:</strong> {{ $producto->codigo }}<br>
                                            <strong>Nombre:</strong> {{ $producto->nombre }}<br>
                                            <strong>Marca:</strong> {{ $producto->marca->caracteristica->nombre }}<br>
                                            <strong>Presentación:</strong> {{ $producto->presentacione->caracteristica->nombre }}<br>
                                            <strong>Categoría:</strong> {{ $producto->categoria->caracteristica->nombre }}<br>
                                            <strong>Stock:</strong> {{ $producto->stock }}<br>
                                            <strong>Stock mínimo:</strong> {{ $producto->stock_minimo }}<br>
                                            <strong>Estado:</strong> @if ($producto->estado == 1) Activo @else Eliminado @endif<br>
                                        </div>
                                        <div class="col-md-6">
                                            @if ($producto->medicina)
                                                <strong>Registro INVIMA:</strong> {{ $producto->medicamento->registro_invima }}<br>
                                                <strong>Concentración:</strong> {{ $producto->medicamento->concentracion }}<br>
                                                <strong>Forma Farmacéutica:</strong> {{ $producto->medicamento->forma_farmaceutica }}<br>
                                                <strong>Principio Activo:</strong> {{ $producto->medicamento->principio_activo }}<br>
                                                <strong>Denominación:</strong> {{ $producto->medicamento->denominacion }}<br>
                                                <strong>Venta Sujeta a Receta:</strong> @if ($producto->medicamento->venta_sujeta) Sí @else No @endif<br>
                                                <strong>Vía de Administración:</strong> {{ $producto->medicamento->via_administracion }}<br>
                                                <strong>Laboratorio:</strong> {{ $producto->medicamento->laboratorio->caracteristica->nombre }}<br>
                                                <strong>Tipo:</strong>  {{ $producto->medicamento->tipos->pluck('caracteristica.nombre')->implode(', ') }}<br>
                                                <strong>Síntomas:</strong>
                                                {{ $producto->medicamento->sintomas->pluck('caracteristica.nombre')->implode(', ') }}<br>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de confirmación-->
                    <div class="modal fade" id="confirmModal-{{ $producto->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $producto->estado == 1 ? '¿Seguro que quieres eliminar el producto?' : '¿Seguro que quieres restaurar el producto?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('admin.producto.destroy', ['producto' => $producto->id]) }}" method="post">
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
            $('#productos').DataTable();

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
