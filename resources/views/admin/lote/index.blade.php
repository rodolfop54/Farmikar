@extends('adminlte::page')

@section('title', 'Lotes')

@section('content_header')
<h1>Lotes</h1>
@stop

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Lotes</li>
    </ol>
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table class="table table-striped table-bordered" id='lotes'>
                <thead class="table-primary">
                    <tr>
                        <th>Numero</th>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Fecha vencimiento</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Tipo producto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lotes as $lote)
                    <tr>
                        <td>
                            {{ $lote->numero_lote }}
                        </td>
                        <td>
                            {{ $lote->producto->nombre }}
                        </td>
                        <td>
                            {{ $lote->stock}}
                        </td>
                        <td>
                            <p class="fw-semibold mb-1"><span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>{{\Carbon\Carbon::parse($lote->fecha_vencimiento)->format('d-m-Y')}}
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">{{ ucfirst($lote->proveedore->tipo_persona) }}</p>
                            <p class="text-muted mb-0">{{$lote->proveedore->razon_social}}</p>
                        </td>
                        <td>
                            <div class="row-not-space">
                                <p class="fw-semibold mb-1"><span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>{{\Carbon\Carbon::parse($lote->fecha_compra)->format('d-m-Y')}}</p>
                                <p class="fw-semibold mb-0"><span class="m-1"><i class="fa-solid fa-clock"></i></span>{{\Carbon\Carbon::parse($lote->fecha_compra)->format('H:i')}}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            @if ($lote->es_medicamento == 1)
                                <span class="badge bg-success">Medicamento</span>
                            @else
                                <span class="badge bg-info">Producto</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @php
                                $hoy = \Carbon\Carbon::now();
                                $vencimiento = \Carbon\Carbon::parse($lote->fecha_vencimiento);
                            @endphp
                            
                            @if ($vencimiento->isToday())
                                <span class="badge bg-warning">Por vencer</span>
                            @elseif ($vencimiento->isFuture())
                                @if ($vencimiento->diffInDays($hoy) <= 30)
                                    <span class="badge bg-warning">Por vencer</span>
                                @else
                                    <span class="badge bg-success">No vencido</span>
                                @endif
                            @else
                                <span class="badge bg-danger">Vencido</span>
                            @endif
                        </td>
                        <td>
                            @can('editar-lote')
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $lote->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            @endcan
                        </td>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $lote->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $lote->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $lote->id }}">Editar lote</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.lote.update', ['lote' => $lote]) }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <input type="hidden" name="edit_id" value="{{ $lote->id }}">
                                            <div class="form-group">
                                                <label for="stock{{ $lote->id }}">Stock:</label>
                                                <input type="number" name="stock" id="stock{{ $lote->id }}" class="form-control" oninput="this.value = this.value.toUpperCase();" value="{{ old('stock', $lote->stock) }}">
                                                @error('stock')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha_vencimiento{{ $lote->id }}">Fecha vencimiento:</label>
                                                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control @error('fecha_vencimiento') is-invalid @enderror" value="{{ old('fecha_vencimiento', $lote->fecha_vencimiento) }}">
                                                @error('fecha_vencimiento')
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


   
    @stop

    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap4.css">
    @stop
    
    @section('js')
        <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap4.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
                $(document).ready(function() {
                $('#lotes').DataTable();
    
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