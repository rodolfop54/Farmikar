<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\CompraController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LaboratorioController;
use App\Http\Controllers\Admin\LoteController;
use App\Http\Controllers\Admin\MarcaController;
use App\Http\Controllers\Admin\PresentacioneController;
use App\Http\Controllers\Admin\Producto;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SintomaController;
use App\Http\Controllers\Admin\TipoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VentaController;

Route::get('', [HomeController::class, 'index'])->name('admin.index')->middleware('auth:sanctum');

Route::resource('/roles', RoleController::class)->names('admin.role');
Route::resource('/users', UserController::class)->names('admin.user')->middleware('auth:sanctum');

Route::resource('/categorias', CategoriaController::class)->names('admin.categoria')->middleware('auth:sanctum');
Route::resource('/marcas', MarcaController::class)->names('admin.marca');
Route::resource('/presentaciones', PresentacioneController::class)->names('admin.presentacione')->middleware('auth:sanctum');
Route::resource('/laboratorios', LaboratorioController::class)->names('admin.laboratorio')->middleware('auth:sanctum');
Route::resource('/tipos', TipoController::class)->names('admin.tipo')->middleware('auth:sanctum');
Route::resource('/sintomas', SintomaController::class)->names('admin.sintoma')->middleware('auth:sanctum');

Route::resource('/productos', ProductoController::class)->names('admin.producto')->middleware('auth:sanctum');
Route::resource('/clientes', ClienteController::class)->names('admin.cliente')->middleware('auth:sanctum');
Route::resource('/proveedores', ProveedorController::class)->names('admin.proveedore')->middleware('auth:sanctum');
Route::resource('/compras', CompraController::class)->names('admin.compra');
Route::resource('/lotes', LoteController::class)->names('admin.lote')->middleware('auth:sanctum');
Route::resource('/ventas', VentaController::class)->names('admin.venta')->middleware('auth:sanctum');

Route::get('/admin/producto/buscar', [ProductoController::class, 'buscar'])->name('admin.producto.buscar');


