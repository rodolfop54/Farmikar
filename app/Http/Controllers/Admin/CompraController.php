<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompraRequest;
use App\Models\Compra;
use App\Models\Comprobante;
use App\Models\Lote;
use App\Models\Producto;
use App\Models\Proveedore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-compra|crear-compra|mostrar-compra|eliminar-compra', ['only' => ['index']]);
        $this->middleware('permission:crear-compra', ['only' => ['create', 'store']]);
        $this->middleware('permission:mostrar-compra', ['only' => ['show']]);
        $this->middleware('permission:eliminar-compra', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */

     
    public function index()
    {
        $compras = Compra::with('proveedore')
        ->where('estado',1)
        ->latest()
        ->get(); 

        $compras = Compra::with('comprobante')->latest()->get(); 

        return view('admin.compra.index',compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedore::where('estado',1)->get();
        $comprobantes = Comprobante::all();
        $lotes = Lote::all();
        $productos = Producto::where('estado',1)->get();
        return view('admin.compra.create',compact('proveedores','comprobantes','productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {

        /* dd($request->all()); */
        try {
            DB::beginTransaction();

            // Llenar tabla compras
            $compra = Compra::create($request->validated());

            // Recuperar los arrays
            $arrayProducto_id = $request->get('arrayidproducto');
            $arrayCantidad = $request->get('arraycantidad');
            $arrayPrecioCompra = $request->get('arraypreciocompra');
            $arrayPrecioVenta = $request->get('arrayprecioventa');
            $arrayLote = $request->get('arraylote');
            $arrayFechaVencimiento = $request->get('arrayfechavencimiento');

            $sizeArray = count($arrayProducto_id);
            for ($cont = 0; $cont < $sizeArray; $cont++) {
                // Llenar tabla compra_producto
                $compra->productos()->sync([
                    $arrayProducto_id[$cont] => [
                        'cantidad' => $arrayCantidad[$cont],
                        'precio_compra' => $arrayPrecioCompra[$cont],
                        'precio_venta' => $arrayPrecioVenta[$cont],
                        'lote' => $arrayLote[$cont]
                    ]
                ], false);

                // Actualizar el stock del producto
                $producto = Producto::find($arrayProducto_id[$cont]);
                $stockActual = $producto->stock;
                $stockNuevo = intval($arrayCantidad[$cont]);
                $producto->update(['stock' => $stockActual + $stockNuevo]);

                // Crear o actualizar el lote
                Lote::updateOrCreate(
                    ['numero_lote' => $arrayLote[$cont], 'producto_id' => $arrayProducto_id[$cont]],
                    [
                        'stock' => DB::raw('stock + ' . $arrayCantidad[$cont]),
                        'fecha_vencimiento' => $arrayFechaVencimiento[$cont],
                        'proveedore_id' => $compra->proveedore_id,
                        'fecha_compra' => $compra->fecha_hora,
                        'es_medicamento' => $producto->medicina
                    ]
                );
            }
            DB::commit();
            return redirect()->route('admin.compra.index');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.compra.index')->with('error', 'Error al registrar la compra: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        return view('admin.compra.show',compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
