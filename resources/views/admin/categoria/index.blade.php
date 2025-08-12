@extends('adminlte::page')

@section('title', 'Categorias')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap4.css">
@endsection

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Categorias</li>
</ol>
    <div class="card card-outline card-primary">
        <div class="card-header">
            @can('crear-categoria')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">
                    Agregar categoría
                </button>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered" id="categorias">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="text-center">{{ $categoria->id }}</td>
                            <td class="text-center">{{ $categoria->caracteristica->nombre }}</td>
                            <td class="text-center">{{ $categoria->caracteristica->descripcion }}</td>
                            <td class="text-center">
                                @if ($categoria->caracteristica->estado == 1)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-danger">Eliminado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    @can('editar-categoria')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $categoria->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button> 
                                    @endcan
                                    @can('eliminar-categoria')
                                        @if ($categoria->caracteristica->estado == 1)
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal-{{$categoria->id}}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        @else
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmModal-{{$categoria->id}}">
                                                <i class="fa-solid fa-arrows-rotate"></i>
                                            </button>
                                        @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Confirm Modal -->
                        <div class="modal fade" id="confirmModal-{{$categoria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $categoria->caracteristica->estado == 1 ? '¿Seguro que quieres eliminar la categoría?' : '¿Seguro que quieres restaurar la categoría?' }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('admin.categoria.destroy',['categoria'=>$categoria->id]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $categoria->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $categoria->id }}">Editar Categoría</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.categoria.update', ['categoria' => $categoria]) }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <input type="hidden" name="edit_id" value="{{ $categoria->id }}">
                                            <div class="form-group">
                                                <label for="nombre{{ $categoria->id }}">Nombre:</label>
                                                <input type="text" name="nombre" id="nombre{{ $categoria->id }}" class="form-control" oninput="this.value = this.value.toUpperCase();" value="{{ old('nombre', $categoria->caracteristica->nombre) }}">
                                                @error('nombre')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion{{ $categoria->id }}">Descripción:</label>
                                                <textarea name="descripcion" id="descripcion{{ $categoria->id }}" rows="3" class="form-control" oninput="this.value = this.value.toUpperCase();">{{ old('descripcion', $categoria->caracteristica->descripcion) }}</textarea>
                                                @error('descripcion')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
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

   <!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Crear Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categoria.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese el nombre" value="{{ old('nombre') }}">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="descripcion" rows="4" placeholder="Ingrese una descripción">{{ old('descripcion') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
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

        //Convertri a mayúsculas
        document.addEventListener('DOMContentLoaded', function() {
        // Convertir el texto a mayúsculas mientras se escribe en el campo 'nombre'
        document.getElementById('nombre').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Convertir el texto a mayúsculas mientras se escribe en el campo 'descripcion'
        document.getElementById('descripcion').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });

        $(document).ready(function() {
            $('#categorias').DataTable();

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

            // Show modal on validation errors
            @if($errors->any())
                @if(old('edit_id'))
                    $('#editModal{{ old('edit_id') }}').modal('show');
                @else
                    $('#createCategoryModal').modal('show');
                @endif
            @endif
        });
    </script>
@endsection