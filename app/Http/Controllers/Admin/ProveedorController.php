<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\StoreProveedoreRequest;
use App\Http\Requests\UpdateProveedoreRequest;
use App\Models\Documento;
use App\Models\Persona;
use App\Models\Proveedore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-proveedore|crear-proveedore|editar-proveedore|eliminar-proveedore', ['only' => ['index']]);
        $this->middleware('permission:crear-proveedore', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-proveedore', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-proveedore', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedore::with('documento')->get();
        return view('admin.proveedore.index',compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all();
        return view('admin.proveedore.create',compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedoreRequest $request)
    {
        try {
            Proveedore::create($request->validated());
            return redirect()->route('admin.proveedore.index')->with('success', 'Proveedor registrado');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Error al registrar el proveedor: ' . $e->getMessage());
            }
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
    public function edit(Proveedore $proveedore)
    {
        $proveedore->load('documento');
        $documentos = Documento::all();
        return view('admin.proveedore.edit',compact('proveedore','documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedoreRequest $request,  $id)
    {
        try {
            $proveedore = Proveedore::find($id); // Buscar el cliente por ID
    
            if ($proveedore) {
                $proveedore->update($request->validated()); // Actualizar el cliente
                return redirect()->route('admin.proveedore.index')->with('success', 'Proveedor actualizado correctamente');
            } else {
                return redirect()->back()->with('error', 'Proveedor no encontrado');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el proveedor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $persona = Persona::find($id);
        if ($persona->estado == 1) {
            Persona::where('id', $persona->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Proveedor eliminado';
        } else {
            Persona::where('id', $persona->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Proveedor restaurado';
        }

        return redirect()->route('admin.proveedore.index')->with('success', $message);
    }
}
