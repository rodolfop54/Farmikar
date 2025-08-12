@extends('adminlte::page')

@section('title', 'Editar proveedor')

@section('content_header')
    <h1>Editar proveedor</h1>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">
@endsection

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.proveedore.index') }}">proveedores</a></li>
    <li class="breadcrumb-item active">Editar proveedore</li>
</ol>
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.proveedore.update',['proveedore'=>$proveedore]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <p>Tipo de proveedor: <span class="fw-bold">{{ strtoupper($proveedore->tipo_persona) }}</span></p>
            </div>
            <div class="card-body card-outline card-primary">

                <div class="form-row">
                    <!-------Razón social------->
                    <div class="form-group col-md-6">
                        @if ($proveedore->tipo_persona == 'natural')
                        <label id="label-natural" for="razon_social" class="form-label">Nombres y apellidos:</label>
                        @else
                        <label id="label-juridica" for="razon_social" class="form-label">Nombre de la empresa:</label>
                        @endif

                        <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social', $proveedore->razon_social) }}">

                        @error('razon_social')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!------Dirección----->
                    <div class="form-group col-md-6">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input required type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $proveedore->direccion) }}">
                        @error('direccion')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <!--------------Documento------->
                    <div class="form-group col-md-6">
                        <label for="documento_id" class="form-label">Tipo de documento:</label>
                        <select class="form-control" name="documento_id" id="documento_id">
                            @foreach ($documentos as $item)
                            <option value="{{ $item->id }}" {{ (old('documento_id', $proveedore->documento_id) == $item->id) ? 'selected' : '' }}>
                                {{ $item->tipo_documento }}
                            </option>
                            @endforeach
                        </select>
                        @error('documento_id')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="numero_documento" class="form-label">Número de documento:</label>
                        <input required type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{ old('numero_documento', $proveedore->numero_documento) }}">
                        @error('numero_documento')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.proveedore.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@stop
