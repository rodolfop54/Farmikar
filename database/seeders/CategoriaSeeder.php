<?php

namespace Database\Seeders;

use App\Models\Caracteristica;
use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categorias = [
            ['nombre' => 'Categoría 1', 'descripcion' => 'Descripción de la categoría 1'],
            ['nombre' => 'Categoría 2', 'descripcion' => 'Descripción de la categoría 2'],
            // Agrega más categorías según sea necesario
        ];

        foreach ($categorias as $categoria) {
            $caracteristica = Caracteristica::create([
                'nombre' => $categoria['nombre'],
                'descripcion' => $categoria['descripcion'],
            ]);

            Categoria::create([
                'caracteristica_id' => $caracteristica->id,
                // Agrega aquí otros campos específicos de la tabla categorias, si los hay
            ]);
        }
    }
}
