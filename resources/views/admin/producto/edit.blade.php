@extends('adminlte::page')

@section('title', 'Editar producto')

@section('content_header')
    <h1>Editar Producto</h1>
@stop


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border-color: #ced4da;
        border-radius: 0.25rem;
        
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        
        line-height: 36px;
    }
    .select2-container .select2-selection--single {
        height: 38px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: black;
    }
</style>
@endsection


@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.producto.index') }}">Productos</a></li>
    <li class="breadcrumb-item active">Editar producto</li>
</ol>
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="form-row">
                <!-- Código -->
                <div class="form-group col-md-2">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo', $producto->codigo) }}" required>
                    @error('codigo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <!-- Nombre -->
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $producto->nombre) }}" required>
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <!-- Categoría -->
                <div class="form-group col-md-6">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
            <div class="form-row">
                <!-- Descripción -->
                <div class="form-group col-md-6">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="2">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <!-- Stock mínimo -->
                <div class="form-group col-md-3">
                    <label for="fecha_vencimiento">Stock mínimo</label>
                    <input type="number" name="stock_minimo" id="stock_minimo" class="form-control @error('stock_minimo') is-invalid @enderror" value="{{ old('stock_minimo', $producto->stock_minimo) }}" required>
                    @error('stock_minimo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <!-- Imagen -->
                <div class="form-group col-md-3">
                    <label for="img_path" class="form-label">Imagen:</label>
                    <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">
                    @error('img_path')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                    @if($producto->img_path)
                        <img src="{{ asset('storage/'.$producto->img_path) }}" alt="Imagen actual" class="img-thumbnail mt-2" style="max-height: 150px;">
                    @endif
                </div>
            </div>
        
            <div class="form-row">
                <!-- Marca -->
                <div class="form-group col-md-6">
                    <label for="marca_id">Marca</label>
                    <select name="marca_id" id="marca_id" class="form-control @error('marca_id') is-invalid @enderror" required>
                        <option value="">Seleccione una marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ old('marca_id', $producto->marca_id) == $marca->id ? 'selected' : '' }}>{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                    @error('marca_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <!-- Presentación -->
                <div class="form-group col-md-6">
                    <label for="presentacione_id">Presentación</label>
                    <select name="presentacione_id" id="presentacione_id" class="form-control @error('presentacione_id') is-invalid @enderror" required>
                        <option value="">Seleccione una presentación</option>
                        @foreach($presentaciones as $presentacion)
                            <option value="{{ $presentacion->id }}" {{ old('presentacione_id', $producto->presentacione_id) == $presentacion->id ? 'selected' : '' }}>{{ $presentacion->nombre }}</option>
                        @endforeach
                    </select>
                    @error('presentacione_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
            <!-- Campo de Medicamento -->
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="es_medicamento" id="es_medicamento" value="1" {{ old('es_medicamento', $producto->medicina) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="es_medicamento">¿Es medicamento?</label>
                </div>
            </div>
        
            <!-- Campos adicionales para medicamento -->
            <div id="medicamento-fields" style="{{ old('es_medicamento', $producto->es_medicamento) ? '' : 'display:none;' }}">
                <div class="form-row">
                    <!-- Registro INVIMA -->
                    <div class="form-group col-md-4">
                        <label for="registro_invima">Registro INVIMA</label>
                        <input type="text" name="registro_invima" id="registro_invima" class="form-control @error('registro_invima') is-invalid @enderror" value="{{ old('registro_invima', $producto->medicamento->registro_invima ?? '') }}">
                        @error('registro_invima')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <!-- Concentración -->
                    <div class="form-group col-md-4">
                        <label for="concentracion">Concentración</label>
                        <input type="text" name="concentracion" id="concentracion" class="form-control @error('concentracion') is-invalid @enderror" value="{{ old('concentracion', $producto->medicamento->concentracion ?? '') }}">
                        @error('concentracion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <!-- Forma Farmacéutica -->
                    <div class="form-group col-md-4">
                        <label for="forma_farmaceutica">Forma Farmacéutica</label>
                        <input type="text" name="forma_farmaceutica" id="forma_farmaceutica" class="form-control @error('forma_farmaceutica') is-invalid @enderror" value="{{ old('forma_farmaceutica', $producto->medicamento->forma_farmaceutica ?? '') }}">
                        @error('forma_farmaceutica')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        
                <div class="form-row">
                    <!-- Principio Activo -->
                    <div class="form-group col-md-4">
                        <label for="principio_activo">Principio Activo</label>
                        <input type="text" name="principio_activo" id="principio_activo" class="form-control @error('principio_activo') is-invalid @enderror" value="{{ old('principio_activo', $producto->medicamento->principio_activo ?? '') }}">
                        @error('principio_activo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                                <!-- Denominación -->
                    <div class="form-group col-md-4">
                        <label for="denominacion">Denominación</label>
                        <select name="denominacion" id="denominacion" class="form-control @error('denominacion') is-invalid @enderror" required>
                            <option value="">Seleccione una denominación</option>
                            <option value="COMERCIAL" {{ old('denominacion', $producto->medicamento->denominacion ?? '') == 'COMERCIAL' ? 'selected' : '' }}>COMERCIAL</option>
                            <option value="GENÉRICO" {{ old('denominacion', $producto->medicamento->denominacion ?? '') == 'GENÉRICO' ? 'selected' : '' }}>GENÉRICO</option>
                        </select>
                        @error('denominacion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Venta Sujeta -->
                    <div class="form-group col-md-4">
                        <label for="venta_sujeta">Venta Sujeta</label>
                        <select name="venta_sujeta" id="venta_sujeta" class="form-control @error('venta_sujeta') is-invalid @enderror">
                            <option value="">Seleccione una opción</option>
                            <option value="NO" {{ old('venta_sujeta', $producto->medicamento->venta_sujeta ?? '') == 'NO' ? 'selected' : '' }}>No</option>
                            <option value="SI" {{ old('venta_sujeta', $producto->medicamento->venta_sujeta ?? '') == 'SI' ? 'selected' : '' }}>Sí</option>
                        </select>
                        @error('venta_sujeta')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        
                <div class="form-row">
                    <!-- Vía Administración -->
                    <div class="form-group col-md-6">
                        <label for="via_administracion">Vía de Administración</label>
                        <input type="text" name="via_administracion" id="via_administracion" class="form-control @error('via_administracion') is-invalid @enderror" value="{{ old('via_administracion', $producto->medicamento->via_administracion ?? '') }}">
                        @error('via_administracion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <!-- Laboratorio -->
                    <div class="form-group col-md-6">
                        <label for="laboratorio_id">Laboratorio</label>
                        <select name="laboratorio_id" id="laboratorio_id" class="form-control @error('laboratorio_id') is-invalid @enderror">
                            <option value="">Seleccione un laboratorio</option>
                            @foreach($laboratorios as $laboratorio)
                                <option value="{{ $laboratorio->id }}" {{ old('laboratorio_id', $producto->medicamento->laboratorio_id ?? '') == $laboratorio->id ? 'selected' : '' }}>{{ $laboratorio->nombre }}</option>
                            @endforeach
                        </select>
                        @error('laboratorio_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        
                <div class="form-row">
                    <!-- Tipo de Medicamento -->
                    <div class="form-group col-md-6">
                        <label for="tipo_id">Tipo de Medicamento</label>
                        <select name="tipos[]" id="tipos" class="form-control selectpicker @error('tipos') is-invalid @enderror" multiple data-live-search="true">
                            <option value="">Seleccione tipos</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" 
                                    {{ in_array($tipo->id, old('sintomas', 
                                        $producto->medicamento && $producto->medicamento->tipos 
                                        ? $producto->medicamento->tipos->pluck('id')->toArray() 
                                        : []
                                    )) ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <!-- Síntomas -->
                    <div class="form-group col-md-6">
                        <label for="sintomas">Síntomas</label>
                        <select name="sintomas[]" id="sintomas" class="form-control selectpicker @error('sintomas') is-invalid @enderror" multiple data-live-search="true">
                            @foreach($sintomas as $sintoma)
                                <option value="{{ $sintoma->id }}" 
                                    {{ in_array($sintoma->id, old('sintomas', 
                                        $producto->medicamento && $producto->medicamento->sintomas 
                                        ? $producto->medicamento->sintomas->pluck('id')->toArray() 
                                        : []
                                    )) ? 'selected' : '' }}>
                                    {{ $sintoma->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('sintomas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


            </div>
        
            <!-- Botones -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                <a href="{{ route('admin.producto.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@stop

@section('js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializa Select2
            $('.select2-enable').select2({
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }
            });

            $('#sintomas').select2({
                placeholder: 'Seleccione síntomas',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }
            });

            $('#tipos').select2({
                placeholder: 'Seleccione tipos',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }
            });
        })

   document.addEventListener('DOMContentLoaded', function() {
    const esMedicamentoCheckbox = document.getElementById('es_medicamento');
    const medicamentoFields = document.getElementById('medicamento-fields');
    
    function toggleMedicamentoFields() {
        if (esMedicamentoCheckbox.checked) {
            medicamentoFields.style.display = 'block';
            // Habilita el atributo required en los campos de medicamento
            medicamentoFields.querySelectorAll('input, select').forEach(function(field) {
                field.required = true;
            });
        } else {
            medicamentoFields.style.display = 'none';
            // Deshabilita el atributo required en los campos de medicamento
            medicamentoFields.querySelectorAll('input, select').forEach(function(field) {
                field.required = false;
            });
        }
    }
    
    // Inicializar visibilidad de los campos
    toggleMedicamentoFields();
    
    // Escuchar cambios en el checkbox
    esMedicamentoCheckbox.addEventListener('change', toggleMedicamentoFields);
});
    </script>
@stop
