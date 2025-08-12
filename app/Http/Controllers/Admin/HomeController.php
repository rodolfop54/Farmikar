<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // Obtener productos con stock bajo
        $productosConStockBajo = Producto::where('stock', '<=', 'stock_minimo')->get();
        $lotesPorVencer = Lote::where('fecha_vencimiento', '<=', now()->addDays(30))->with('producto')->get();


        return view('admin.index', compact('productosConStockBajo', 'lotesPorVencer'));
    }
}
