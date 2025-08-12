<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Requests\UpdateLaboratorioRequest;
use App\Models\Caracteristica;
use App\Models\Laboratorio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaboratorioController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-laboratorio|crear-laboratorio|editar-laboratorio|eliminar-laboratorio', ['only' => ['index']]);
        $this->middleware('permission:crear-laboratorio', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-laboratorio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-laboratorio', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laboratorios = Laboratorio::with('caracteristica')->latest()->get();
        return view('admin.laboratorio.index',compact('laboratorios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laboratorio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request)
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->laboratorio()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.laboratorio.index')->with('success', 'Laboratorio registrada');
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
    public function edit(Laboratorio $laboratorio)
    {
        return view('admin.laboratorio.edit', ['laboratorio' => $laboratorio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaboratorioRequest $request, Laboratorio $laboratorio)
    {
        Caracteristica::where('id', $laboratorio->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('admin.laboratorio.index')->with('success', 'laboratorio editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $laboratorio = Laboratorio::find($id);
        if ($laboratorio->caracteristica->estado == 1) {
            Caracteristica::where('id', $laboratorio->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Laboratorio eliminado';
        } else {
            Caracteristica::where('id', $laboratorio->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Laboratorio restaurado';
        }

        return redirect()->route('admin.laboratorio.index')->with('success', $message);
    
    }
}
