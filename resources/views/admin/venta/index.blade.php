@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Ventas</h1>
@stop

@section('content')

{{-- @include('layouts.partials.alert') --}}
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Compras</li>
</ol>

<div class="card card-outline card-primary">
    <div class="card-header">
        @can('crear-venta')
            <a href="{{ route('admin.venta.create') }}">
                <button type="button" class="btn btn-primary">Nueva compra</button>
            </a>
        @endcan
    </div>
    <div class="card-body">
        <table  class="table table-striped table-bordered" id="ventas">
            <thead class="table-primary">
                <tr>
                    <th>Comprobante</th>
                    <th>Cliente</th>
                    <th>Fecha y hora</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $item)
                <tr>
                    <td>
                        <p class="fw-semibold mb-1">{{$item->comprobante->tipo_comprobante}}</p>
                        <p class="text-muted mb-0">{{$item->numero_comprobante}}</p>
                    </td>
                    <td>
                        <p class="fw-semibold mb-1">{{ ucfirst($item->cliente->tipo_persona) }}</p>
                        <p class="text-muted mb-0">{{$item->cliente->razon_social}}</p>
                    </td>
                    <td>
                        <div class="row-not-space">
                            <p class="fw-semibold mb-1"><span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>{{\Carbon\Carbon::parse($item->fecha_hora)->format('d-m-Y')}}</p>
                            <p class="fw-semibold mb-0"><span class="m-1"><i class="fa-solid fa-clock"></i></span>{{\Carbon\Carbon::parse($item->fecha_hora)->format('H:i')}}</p>
                        </div>
                    </td>
                    <td>
                        {{$item->total}}
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            @can('ver-venta')
                                <form action="{{route('admin.venta.show', ['venta'=>$item]) }}" method="get">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </form>
                            @endcan
                            @can('eliminar-venta')
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal-{{$item->id}}"><i class="fa-solid fa-trash-can"></i></button>
                            @endcan
                        </div>
                    </td>

                </tr>

                <!-- Modal de confirmación-->
                <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Seguro que quieres eliminar el registro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <form action="{{ route('admin.compra.destroy',['compra'=>$item->id]) }}" method="post">
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
        $('#ventas').DataTable();

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
