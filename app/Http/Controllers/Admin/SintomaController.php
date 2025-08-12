<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdateSintomaRequest;
use App\Models\Caracteristica;
use App\Models\Sintoma;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SintomaController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-sintoma|crear-sintoma|editar-sintoma|eliminar-sintoma', ['only' => ['index']]);
        $this->middleware('permission:crear-sintoma', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-sintoma', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-sintoma', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sintomas = Sintoma::with('caracteristica')->latest()->get();
        return view('admin.sintoma.index',compact('sintomas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sintoma.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request)
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->sintoma()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.sintoma.index')->with('success', 'Síntoma registrado');
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
    public function edit(Sintoma $sintoma)
    {
        return view('admin.sintoma.edit', ['sintoma' => $sintoma]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSintomaRequest $request, Sintoma $sintoma)
    {
        Caracteristica::where('id', $sintoma->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('admin.sintoma.index')->with('success', 'Síntoma editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $sintoma = Sintoma::find($id);
        if ($sintoma->caracteristica->estado == 1) {
            Caracteristica::where('id', $sintoma->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Síntoma eliminado';
        } else {
            Caracteristica::where('id', $sintoma->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Síntoma restaurado';
        }

        return redirect()->route('admin.sintoma.index')->with('success', $message);
    }
}
