<?php

namespace App\Models;

use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;



    public function cliente() {
        return $this->hasMany(Cliente::class);
    }

    public function proveedore() {
        return $this->hasMany(Proveedore::class);
    }
}

