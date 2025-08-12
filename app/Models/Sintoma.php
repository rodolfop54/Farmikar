<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    use HasFactory;

    public function caracteristica() {
        return $this->belongsTo(Caracteristica::class);
    }

    public function medicamentos() {
        return $this->belongsToMany(Medicamento::class, 'medicamento_sintoma')->withTimestamps();
    }

    protected $fillable = ['caracteristica_id'];
}
