<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $fillable = ['numero_lote', 'producto_id', 'stock', 'fecha_vencimiento', 'proveedore_id', 'fecha_compra', 'es_medicamento'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
        
    }

    public function proveedore() {
        return $this->belongsTo(Proveedore::class, 'proveedore_id');
    }
}
