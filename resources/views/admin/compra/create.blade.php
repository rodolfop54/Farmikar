@extends('adminlte::page')

@section('title', 'Realizar compra')

@section('content_header')
    <h1>Realizar compra</h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.compra.index')}}">Compras</a></li>
        <li class="breadcrumb-item active">Crear Compra</li>
    </ol>
    <form action="{{ route('admin.compra.store') }}" method="POST">
        @csrf
    
        <div class="container-fluid mt-4">
            <div class="row gy-4">
                <!------Compra producto---->
                <div class="col-xl-9">
                    <div class="text-white bg-primary p-1 text-center">
                        Detalles de la compra
                    </div>
                    <div class="p-3 border border-3 border-primary">
                        <div class="row">
                            <!-----Producto---->
                            <div class="col-12 mb-4">
                                <div class="row">
                                    <!-- Select de producto -->
                                    <div class="col-md-6">
                                        <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" data-size="1" title="Busque un producto aquí">
                                            @foreach ($productos as $item)
                                                <option value="{{$item->id}}">{{$item->codigo.' '.$item->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            
                                    <!-- Input de código de barras -->
                                    <div class="col-md-6">
                                        <input type="text" id="codigo_barras" class="form-control" placeholder="Escanea el código de barras aquí" autofocus>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <!-- Cantidad -->
                                <div class="col-sm-2 mb-2">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control">
                                </div>
                            
                                <!-- Precio de compra -->
                                <div class="col-sm-2 mb-2">
                                    <label for="precio_compra" class="form-label">Precio de compra:</label>
                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.1">
                                </div>
                            
                                <!-- Precio de venta -->
                                <div class="col-sm-2 mb-2">
                                    <label for="precio_venta" class="form-label">Precio de venta:</label>
                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                                </div>
                            
                                <!-- Lote -->
                                <div class="col-sm-3 mb-2">
                                    <label for="lote" class="form-label">Lote:</label>
                                    <input type="text" name="lote" id="lote" class="form-control">
                                </div>
                            
                                <!-- Fecha de vencimiento -->
                                <div class="col-sm-3 mb-2">
                                    <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento:</label>
                                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control">
                                </div>
                            </div>
                            <!-----botón para agregar--->
                            <div class="col-12 mb-4 mt-2 text-end">
                                <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                            </div>
    
                            <!-----Tabla para el detalle de la compra--->
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tabla_detalle" class="table table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th class="text-white">Producto</th>
                                                <th class="text-white">Cantidad</th>
                                                <th class="text-white">Precio compra</th>
                                                <th class="text-white">Precio venta</th>
                                                <th class="text-white">Lote</th>
                                                <th class="text-white">Fecha venc.</th>
                                                <th class="text-white">Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th colspan="6">Sumas</th>
                                                <th colspan="2"><span id="sumas">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="6">IGV %</th>
                                                <th colspan="2"><span id="igv">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="6">Total</th>
                                                <th colspan="2"> <input type="hidden" name="total" value="0" id="inputTotal"> <span id="total">0</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
    
                            <!--Boton para cancelar compra-->
                            <div class="col-12 mt-2">
                                <button id="cancelar" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                    Cancelar compra
                                </button>
                            </div>
    
                        </div>
                    </div>
                </div>
    
                <!-----Compra---->
                <div class="col-xl-3">
                    <div class="text-white bg-success p-1 text-center">
                        Datos generales
                    </div>
                    <div class="p-3 border border-3 border-success">
                        <div class="row">
                            <!--Proveedor-->
                            <div class="col-12 mb-2">
                                <label for="proveedore_id" class="form-label">Proveedor:</label>
                                <select name="proveedore_id" id="proveedore_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                                    @foreach ($proveedores as $item)
                                    <option value="{{$item->id}}">{{$item->razon_social}}</option>
                                    @endforeach
                                </select>
                                @error('proveedore_id')
                                <small class="text-danger">{{ '*'.$message }}</small>
                                @enderror
                            </div>
    
                            <!--Tipo de comprobante-->
                            <div class="col-12 mb-2">
                                <label for="comprobante_id" class="form-label">Comprobante:</label>
                                <select name="comprobante_id" id="comprobante_id" class="form-control selectpicker" title="Selecciona">
                                    @foreach ($comprobantes as $item)
                                    <option value="{{$item->id}}">{{$item->tipo_comprobante}}</option>
                                    @endforeach
                                </select>
                                @error('comprobante_id')
                                <small class="text-danger">{{ '*'.$message }}</small>
                                @enderror
                            </div>
    
                            <!--Numero de comprobante-->
                            <div class="col-12 mb-2">
                                <label for="numero_comprobante" class="form-label">Numero de comprobante:</label>
                                <input required type="text" name="numero_comprobante" id="numero_comprobante" class="form-control">
                                @error('numero_comprobante')
                                <small class="text-danger">{{ '*'.$message }}</small>
                                @enderror
                            </div>
    
                            <!--Impuesto---->
                            <div class="col-sm-6 mb-2">
                                <label for="impuesto" class="form-label">Impuesto(IVA):</label>
                                <input readonly type="text" name="impuesto" id="impuesto" class="form-control border-success">
                                @error('impuesto')
                                <small class="text-danger">{{ '*'.$message }}</small>
                                @enderror
                            </div>
    
                            <!--Fecha--->
                            <div class="col-sm-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                                <?php
    
                                use Carbon\Carbon;
    
                                $fecha_hora = Carbon::now()->toDateTimeString();
                                ?>
                                <input type="hidden" name="fecha_hora" value="{{$fecha_hora}}">
                            </div>
    
                            <!--Botones--->
                            <div class="col-12 mt-4 text-center">
                                <button type="submit" class="btn btn-success" id="guardar">Realizar compra</button>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal para cancelar la compra -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quieres cancelar la compra?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button id="btnCancelarCompra" type="button" class="btn btn-danger" data-dismiss="modal">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    
    </form>
@endsection
@section('js')
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
   <script>
       $(document).ready(function() {

            // Contraer el sidebar
           $('body').addClass('sidebar-collapse');
           $('#codigo_barras').focus();
            $('#codigo_barras').on('input', function() {
                buscarProductoPorCodigo($(this).val());
            });
           $('#btn_agregar').click(function() {
               agregarProducto();
           });
   
           $('#btnCancelarCompra').click(function() {
               cancelarCompra();
           });
   
           disableButtons();
   
           $('#impuesto').val(impuesto + '%');
       });
   
       //Variables
       let cont = 0;
       let subtotal = [];
       let sumas = 0;
       let igv = 0;
       let total = 0;
   
       //Constantes
       const impuesto = 0;
       
       function buscarProductoPorCodigo(codigoBarras) {
        let encontrado = false;

        // Recorrer las opciones del select de productos
        $('#producto_id option').each(function() {
            let productoCodigo = $(this).text().split(' ')[0]; // Obtener el código de barras del texto de la opción
            
            // Si el código de barras coincide
            if (productoCodigo === codigoBarras) {
                $('#producto_id').selectpicker('val', $(this).val()); // Selecciona el producto en el select
                encontrado = true;
                $('#codigo_barras').val(''); // Limpia el input del código de barras
                return false; // Detiene el loop
            }
        });

        if (!encontrado) {
            showModal('Producto no encontrado');
        }

        function showModal(message, icon = 'error') {
            Swal.fire({
                icon: icon,
                title: message,
                timer: 2000,
                showConfirmButton: false
            });
        }
    }
   
       function cancelarCompra() {
           //Elimar el tbody de la tabla
           $('#tabla_detalle tbody').empty();
   
           //Añadir una nueva fila a la tabla
           let fila = '<tr>' +
               '<th></th>' +
               '<td></td>' +
               '<td></td>' +
               '<td></td>' +
               '<td></td>' +
               '<td></td>' +
               '<td></td>' +
               '<td></td>' +
               '<td></td>' +
               '</tr>';
           $('#tabla_detalle').append(fila);
   
           //Reiniciar valores de las variables
           cont = 0;
           subtotal = [];
           sumas = 0;
           igv = 0;
           total = 0;
   
           //Mostrar los campos calculados
           $('#sumas').html(sumas);
           $('#igv').html(igv);
           $('#total').html(total);
           $('#impuesto').val(impuesto + '%');
           $('#inputTotal').val(total);
   
           limpiarCampos();
           disableButtons();
       }
   
       function disableButtons() {
           if (total == 0) {
               $('#guardar').hide();
               $('#cancelar').hide();
           } else {
               $('#guardar').show();
               $('#cancelar').show();
           }
       }
   
       function agregarProducto() {
           //Obtener valores de los campos
           let idProducto = $('#producto_id').val();
           let nameProducto = ($('#producto_id option:selected').text()).split(' ')[1];
           let cantidad = $('#cantidad').val();
           let precioCompra = $('#precio_compra').val();
           let precioVenta = $('#precio_venta').val();
           let lote = $('#lote').val();
           let fechaVencimiento = $('#fecha_vencimiento').val();
   
           //Validaciones 
           //1.Para que los campos no esten vacíos
           if (nameProducto != '' && nameProducto != undefined && cantidad != '' && precioCompra != '' && precioVenta != '' && lote != '' && fechaVencimiento != '') {
   
               //2. Para que los valores ingresados sean los correctos
               if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(precioCompra) > 0 && parseFloat(precioVenta) > 0) {
   
                   //3. Para que el precio de compra sea menor que el precio de venta
                   if (parseFloat(precioVenta) > parseFloat(precioCompra)) {
                       //Calcular valores
                       subtotal[cont] = round(cantidad * precioCompra);
                       sumas += subtotal[cont];
                       igv = round(sumas / 100 * impuesto);
                       total = round(sumas + igv);
   
                       //Crear la fila
                       let fila = '<tr id="fila' + cont + '">' +
                           '<th>' + (cont + 1) + '</th>' +
                           '<td><input type="hidden" name="arrayidproducto[]" value="' + idProducto + '">' + nameProducto + '</td>' +
                           '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
                           '<td><input type="hidden" name="arraypreciocompra[]" value="' + precioCompra + '">' + precioCompra + '</td>' +
                           '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' + precioVenta + '</td>' +
                           '<td><input type="hidden" name="arraylote[]" value="' + lote + '">' + lote + '</td>' +
                           '<td><input type="hidden" name="arrayfechavencimiento[]" value="' + fechaVencimiento + '">' +  fechaVencimiento + '</td>' +
                           '<td>' + subtotal[cont] + '</td>' +
                       '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont + ')"><i class="fa-solid fa-trash"></i></button></td>' +
                       '</tr>';

                   //Acciones después de añadir la fila
                   $('#tabla_detalle').append(fila);
                   limpiarCampos();
                   cont++;
                   disableButtons();

                   //Mostrar los campos calculados
                   $('#sumas').html(sumas);
                   $('#igv').html(igv);
                   $('#total').html(total);
                   $('#impuesto').val(igv);
                   $('#inputTotal').val(total);
               } else {
                   showModal('Precio de compra incorrecto');
               }

           } else {
               showModal('Valores incorrectos');
           }

       } else {
           showModal('Le faltan campos por llenar');
       }



   }

   function eliminarProducto(indice) {
       //Calcular valores
       sumas -= round(subtotal[indice]);
       igv = round(sumas / 100 * impuesto);
       total = round(sumas + igv);

       //Mostrar los campos calculados
       $('#sumas').html(sumas);
       $('#igv').html(igv);
       $('#total').html(total);
       $('#impuesto').val(igv);
       $('#InputTotal').val(total);

       //Eliminar el fila de la tabla
       $('#fila' + indice).remove();

       disableButtons();

   }

   function limpiarCampos() {
       let select = $('#producto_id');
       select.selectpicker('val', '');
       $('#cantidad').val('');
       $('#precio_compra').val('');
       $('#precio_venta').val('');
   }

   function round(num, decimales = 2) {
       var signo = (num >= 0 ? 1 : -1);
       num = num * signo;
       if (decimales === 0) //con 0 decimales
           return signo * Math.round(num);
       // round(x * 10 ^ decimales)
       num = num.toString().split('e');
       num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
       // x * 10 ^ (-decimales)
       num = num.toString().split('e');
       return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
   }
   //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario

   function showModal(message, icon = 'error') {
       const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer: 3000,
           timerProgressBar: true,
           didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
           }
       })

       Toast.fire({
           icon: icon,
           title: message
       })
   }
</script>
@endsection 
    