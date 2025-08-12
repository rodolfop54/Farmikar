<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdateTipoRequest;
use App\Models\Caracteristica;
use App\Models\Tipo;
use Egulias\EmailValidator\Warning\TLD;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-tipo|crear-tipo|editar-tipo|eliminar-tipo', ['only' => ['index']]);
        $this->middleware('permission:crear-tipo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-tipo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-tipo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = Tipo::with('caracteristica')->latest()->get();

        return view('admin.tipo.index',compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request)
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->tipo()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.tipo.index')->with('success', 'Tipo registrado');
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
    public function edit(Tipo $tipo)
    {
        return view('admin.tipo.edit', ['tipo' => $tipo]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipoRequest $request, Tipo $tipo)
    {
        Caracteristica::where('id', $tipo->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('admin.tipo.index')->with('success', 'Tipo editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $tipo = Tipo::find($id);
        if ($tipo->caracteristica->estado == 1) {
            Caracteristica::where('id', $tipo->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Tipo eliminado';
        } else {
            Caracteristica::where('id', $tipo->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Tipo restaurado';
        }

        return redirect()->route('admin.tipo.index')->with('success', $message);
    }
}
