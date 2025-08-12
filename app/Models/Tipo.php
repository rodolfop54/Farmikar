<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    public function medicamentos() {
        return $this->belongsToMany(Medicamento::class, 'medicamento_tipo')->withTimestamps();
    }

    public function caracteristica() {
        return $this->belongsTo(Caracteristica::class);
    }
    
     protected $fillable = ['caracteristica_id'];
}
