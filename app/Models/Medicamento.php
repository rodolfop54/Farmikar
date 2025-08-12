<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id', 'registro_invima', 'concentracion', 'forma_farmaceutica', 
        'principio_activo', 'denominacion', 'venta_sujeta', 'via_administracion', 
        'laboratorio_id',
    ];

    public function tipos() {
        return $this->belongsToMany(Tipo::class, 'medicamento_tipo')->withTimestamps();
    }

    public function laboratorio() {
        return $this->belongsTo(Laboratorio::class);
    }

    public function sintomas() {
        return $this->belongsToMany(Sintoma::class, 'medicamento_sintoma')->withTimestamps();
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
