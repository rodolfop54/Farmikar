@extends('adminlte::page')

@section('title', 'Síntomas')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap4.css">
@endsection

@section('content_header')
    <h1>Síntomas</h1>
@stop

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Síntomas</li>
</ol>
    <div class="card">
        <div class="card-header">
            @can('crear-sintoma')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSintomaModal">
                    Agregar síntoma
                </button>
            @endcan
           
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered" id="sintomas">
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
                    @foreach ($sintomas as $sintoma)
                        <tr>
                            <td class="text-center">{{ $sintoma->id }}</td>
                            <td class="text-center">{{ $sintoma->caracteristica->nombre }}</td>
                            <td class="text-center">{{ $sintoma->caracteristica->descripcion }}</td>
                            <td class="text-center">
                                @if ($sintoma->caracteristica->estado == 1)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-danger">Eliminado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    @can('editar-sintoma')
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editModal{{ $sintoma->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    @endcan
                                    @can('eliminar-sintoma')
                                        @if ($sintoma->caracteristica->estado == 1)
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#confirmModal-{{ $sintoma->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        @else
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#confirmModal-{{ $sintoma->id }}">
                                                <i class="fa-solid fa-arrows-rotate"></i>
                                            </button>
                                        @endif
                                    @endcan
                                   
                                </div>
                            </td>
                        </tr>

                        <!-- Confirm Modal -->
                        <div class="modal fade" id="confirmModal-{{ $sintoma->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $sintoma->caracteristica->estado == 1 ? '¿Seguro que quieres eliminar el síntoma?' : '¿Seguro que quieres restaurar el síntoma?' }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <form action="{{ route('admin.sintoma.destroy', ['sintoma' => $sintoma->id]) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $sintoma->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel{{ $sintoma->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $sintoma->id }}">Editar síntoma</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.sintoma.update', ['sintoma' => $sintoma]) }}"
                                            method="post">
                                            @method('PATCH')
                                            @csrf
                                            <input type="hidden" name="edit_id" value="{{ $sintoma->id }}">
                                            <div class="form-group">
                                                <label for="nombre{{ $sintoma->id }}">Nombre:</label>
                                                <input type="text" name="nombre" id="nombre{{ $sintoma->id }}"
                                                    class="form-control" oninput="this.value = this.value.toUpperCase();"
                                                    value="{{ old('nombre', $sintoma->caracteristica->nombre) }}">
                                                @error('nombre')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion{{ $sintoma->id }}">Descripción:</label>
                                                <textarea name="descripcion" id="descripcion{{ $sintoma->id }}" rows="3" class="form-control"
                                                    oninput="this.value = this.value.toUpperCase();">{{ old('descripcion', $sintoma->caracteristica->descripcion) }}</textarea>
                                                @error('descripcion')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
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
    <div class="modal fade" id="createSintomaModal" tabindex="-1" role="dialog"
        aria-labelledby="createSintomaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSintomaModalLabel">Crear síntoma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.sintoma.store') }}" method="POST">
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
            $('#sintomas').DataTable();

            // Show success message
            @if (session('success'))
                let message = "{{ session('success') }}";
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
            @if ($errors->any())
                @if (old('edit_id'))
                    $('#editModal{{ old('edit_id') }}').modal('show');
                @else
                    $('#createSintomaModal').modal('show');
                @endif
            @endif
        });
    </script>
@endsection
