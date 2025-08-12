<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_hora',
        'impuesto',
        'numero_comprobante',
        'total',
        'comprobante_id',
        'proveedore_id'
    ];


    // Relación con productos a través de la tabla intermedia compra_producto
    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot('cantidad', 'precio_compra', 'precio_venta', 'lote');
    }

    // Relación con lotes a través de compra_producto

    public function proveedore() {
        return $this->belongsTo(Proveedore::class, 'proveedore_id');
    }

    public function comprobante() {
        return $this->belongsTo(Comprobante::class);
    }
}
