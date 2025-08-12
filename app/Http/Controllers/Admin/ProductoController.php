<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
use App\Models\Laboratorio;
use App\Models\Marca;
use App\Models\Medicamento;
use App\Models\Presentacione;
use App\Models\Producto;
use App\Models\Sintoma;
use App\Models\Tipo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|eliminar-producto', ['only' => ['index']]);
        $this->middleware('permission:crear-producto', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-producto', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-producto', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        // Cargar los productos con sus medicamentos y características relacionadas
        $productos = Producto::with(['medicamento', 'marca', 'presentacione', 'categoria'])->latest()->get();
        return view('admin.producto.index', compact('productos'));
    }

    public function create()
    {
        // Cargar las características relacionadas para los select inputs
        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
        ->select('marcas.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
        ->select('presentaciones.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
        ->select('categorias.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

    // Obtener laboratorios y tipos de medicamentos si es necesario
        $laboratorios = Laboratorio::join('caracteristicas as c', 'laboratorios.caracteristica_id', '=', 'c.id')
        ->select('laboratorios.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $tipos = Tipo::join('caracteristicas as c', 'tipos.caracteristica_id', '=', 'c.id')
        ->select('tipos.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $sintomas = Sintoma::join('caracteristicas as c', 'sintomas.caracteristica_id', '=', 'c.id')
        ->select('sintomas.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        return view('admin.producto.create', compact('marcas', 'presentaciones', 'laboratorios', 'tipos', 'categorias', 'sintomas'));
    }

    public function store(StoreProductoRequest $request)
{
    // Obtenemos los datos del producto
    $productoData = $request->only([
        'codigo',
        'nombre',
        'descripcion',
        'stock_minimo',
        'categoria_id',
        'marca_id',
        'presentacione_id'
    ]);

    // Añadimos el campo medicina, que será true si es_medicamento está marcado
    $productoData['medicina'] = $request->has('es_medicamento') && $request->input('es_medicamento');

    // Manejar la carga de la imagen
    if ($request->hasFile('img_path')) {
        $productoData['img_path'] = $this->handleUploadImage($request->file('img_path'));
    }

    // Guardar el producto
    $producto = Producto::create($productoData);

    // Si es un medicamento, guardar la información adicional
    if ($productoData['medicina']) {
        $medicamentoData = array_merge(
            $request->only([
                'registro_invima',
                'concentracion',
                'forma_farmaceutica',
                'principio_activo',
                'denominacion',
                'venta_sujeta',
                'via_administracion',
                'laboratorio_id'
            ]),
            ['producto_id' => $producto->id]
        );

        $medicamento = Medicamento::create($medicamentoData);


        // Tabla medicamento_tipo
        $tipos = $request->input('tipos', []);
        if (!empty($tipos)) {
            $medicamento->tipos()->attach($tipos);
        }
        // Tabla medicamento_sintoma
        $sintomas = $request->input('sintomas', []);
        if (!empty($sintomas)) {
            $medicamento->sintomas()->attach($sintomas);
        }

        
    }

    return redirect()->route('admin.producto.index')->with('success', 'Producto creado exitosamente');
}
// Método para manejar la subida de imágenes
    
    public function show(Producto $producto)
    {
        return view('admin.producto.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        // Cargar las características relacionadas para los select inputs
        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
        ->select('marcas.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
        ->select('presentaciones.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
        ->select('categorias.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

    // Obtener laboratorios y tipos de medicamentos si es necesario
        $laboratorios = Laboratorio::join('caracteristicas as c', 'laboratorios.caracteristica_id', '=', 'c.id')
        ->select('laboratorios.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $tipos = Tipo::join('caracteristicas as c', 'tipos.caracteristica_id', '=', 'c.id')
        ->select('tipos.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();

        $sintomas = Sintoma::join('caracteristicas as c', 'sintomas.caracteristica_id', '=', 'c.id')
        ->select('sintomas.id as id', 'c.nombre as nombre')
        ->where('c.estado', 1)
        ->get();


        return view('admin.producto.edit', compact('producto','marcas', 'presentaciones', 'laboratorios', 'tipos', 'categorias', 'sintomas'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        // Obtenemos los datos del producto a actualizar
    $productoData = $request->only([
        'codigo',
        'nombre',
        'descripcion',
        'stock_minimo',
        'categoria_id',
        'marca_id',
        'presentacione_id'
    ]);

    // Verificar si el producto es un medicamento
    $productoData['medicina'] = $request->has('es_medicamento') && $request->input('es_medicamento');

    // Verificar y manejar la subida de la imagen (si se subió una nueva imagen)
    if ($request->hasFile('img_path')) {
        // Eliminar la imagen anterior si existe
        if ($producto->img_path) {
            Storage::disk('public')->delete($producto->img_path);
        }
        // Subir la nueva imagen
        $productoData['img_path'] = $this->handleUploadImage($request->file('img_path'));
    }

    // Actualizar el producto en la base de datos
    $producto->update($productoData);

    // Si el producto es un medicamento, actualizamos la tabla de medicamentos
    if ($productoData['medicina']) {
        $medicamento = Medicamento::where('producto_id', $producto->id)->first();
        $medicamentoData = $request->only([
            'registro_invima',
            'concentracion',
            'forma_farmaceutica',
            'principio_activo',
            'denominacion',
            'venta_sujeta',
            'via_administracion',
            'laboratorio_id',
            'tipo_id'
        ]);

        if ($medicamento) {
            $medicamento->update($medicamentoData);
        } else {
            $medicamentoData['producto_id'] = $producto->id;
            $medicamento = Medicamento::create($medicamentoData);
        }

        $tipos = $request->input('tipos', []);
        if (!empty($tipos)) {
            $medicamento->tipos()->sync($tipos);
        } else {
            $medicamento->tipos()->detach();
        }

        $sintomas = $request->input('sintomas', []);
        if (!empty($sintomas)) {
            $medicamento->sintomas()->sync($sintomas);
        } else {
            $medicamento->sintomas()->detach();
        }
    } else {
        Medicamento::where('producto_id', $producto->id)->delete();
    }

    return redirect()->route('admin.producto.index')->with('success', 'Producto actualizado exitosamente');
}

    public function destroy(string $id)
    {
        $message = '';
        $producto = Producto::find($id);
        if ($producto->estado == 1) {
            Producto::where('id', $producto->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Producto eliminado';
        } else {
            Producto::where('id', $producto->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Producto restaurado';
        }

        return redirect()->route('admin.producto.index')->with('success', $message);
    }

    private function handleUploadImage($image)
{
    if ($image) {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('productos', $imageName, 'public');
        return $path; // This will return 'productos/imagename.jpg'
    }
    return null;
}

}