<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    public function categoria() {
        return $this->hasOne(Categoria::class);
    }

    public function marca() {
        return $this->hasOne(Marca::class);
    }

    
    public function presentacione() {
        return $this->hasOne(Presentacione::class);
    }

    public function tipo() {
        return $this->hasOne(Tipo::class);
    }

    public function laboratorio() {
        return $this->hasOne(Laboratorio::class);
    }

    public function sintoma() {
        return $this->hasOne(Sintoma::class);
    }

    protected $fillable = ['nombre', 'descripcion'];
}
