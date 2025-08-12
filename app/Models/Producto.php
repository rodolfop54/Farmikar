<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 'nombre', 'stock', 'descripcion', 'stock_minimo', 'img_path', 
       'categoria_id', 'marca_id', 'presentacione_id', 'medicina'
    ];

    protected $casts = [
        'fecha_vencimiento' => 'date',
        'es_medicamento' => 'boolean',
    ];

    public function marca() 
    {
        return $this->belongsTo(Marca::class);
    }
    
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_producto')->withTimestamps()
            ->withPivot('cantidad', 'precio_compra', 'precio_venta', 'lote');
    }


    public function ventas()
    {
        return $this->belongsToMany(Venta::class)->withTimestamps()
            ->withPivot('cantidad', 'precio_venta', 'descuento');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function presentacione()
    {
        return $this->belongsTo(Presentacione::class);
    }

    public function medicamento()
    {
        return $this->hasOne(Medicamento::class);
    }

    
   
}