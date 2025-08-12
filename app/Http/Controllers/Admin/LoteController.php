<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-lote|editar-lote', ['only' => ['index']]);
        $this->middleware('permission:editar-lote', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-lote', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $lotes = Lote::with(['producto', 'proveedore'])->latest()->get();
        return view('admin.lote.index', compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        // 1. Validar los datos de entrada
        $request->validate([
            'stock' => 'required|integer|min:1',
            'fecha_vencimiento' => 'required|date',
        ]);
    
        // 2. Buscar el lote por su ID
        $lote = Lote::findOrFail($id);
    
        // 3. Actualizar los valores del lote
        $lote->stock = $request->input('stock');
        $lote->fecha_vencimiento = $request->input('fecha_vencimiento');
    
        // 4. Guardar los cambios en la base de datos
        $lote->save();
    
        // 5. Redirigir o mostrar mensaje de éxito
        return redirect()->route('admin.lote.index')->with('success', 'Lote actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
