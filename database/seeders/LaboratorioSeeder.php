<?php

namespace Database\Seeders;

use App\Models\Caracteristica;
use App\Models\Laboratorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratorioSeeder extends Seeder
{
    public function run()
    {
        $laboratorios = [
            ['nombre' => 'Tecnoquímicas', 'descripcion' => 'Uno de los laboratorios más grandes de Colombia, especializado en medicamentos de venta libre y de prescripción.'],
            ['nombre' => 'Laboratorios Baxter', 'descripcion' => 'Multinacional con una presencia sólida en Colombia, especializada en productos médicos, farmacéuticos y biotecnológicos.'],
            ['nombre' => 'Laboratorio Genfar', 'descripcion' => 'Compañía farmacéutica que produce medicamentos genéricos y de venta libre en toda América Latina.'],
            ['nombre' => 'Abbott', 'descripcion' => 'Multinacional estadounidense con una fuerte presencia en Colombia, enfocada en productos farmacéuticos, diagnósticos y nutrición.'],
            ['nombre' => 'Sanofi', 'descripcion' => 'Laboratorio multinacional de origen francés, con una amplia gama de productos farmacéuticos y vacunas.'],
            ['nombre' => 'Bayer', 'descripcion' => 'Compañía global especializada en productos farmacéuticos, con una presencia significativa en el mercado colombiano.'],
            ['nombre' => 'Pfizer', 'descripcion' => 'Multinacional estadounidense que desarrolla medicamentos innovadores y vacunas.'],
            ['nombre' => 'Novartis', 'descripcion' => 'Compañía multinacional suiza que produce medicamentos de prescripción, terapias biológicas y productos farmacéuticos innovadores.'],
            ['nombre' => 'Laboratorios La Sante', 'descripcion' => 'Laboratorio colombiano especializado en medicamentos genéricos y productos de salud accesibles.'],
            ['nombre' => 'Roche', 'descripcion' => 'Empresa suiza líder en biotecnología y diagnóstico, con una fuerte presencia en el mercado colombiano.'],
            ['nombre' => 'Laboratorio Procaps', 'descripcion' => 'Compañía colombiana que se enfoca en la producción de medicamentos y suplementos nutricionales.'],
            ['nombre' => 'Merck Sharp & Dohme (MSD)', 'descripcion' => 'Multinacional con presencia global que desarrolla una variedad de medicamentos y vacunas.'],
            ['nombre' => 'Laboratorios Biogen', 'descripcion' => 'Empresa farmacéutica colombiana dedicada al desarrollo y distribución de productos genéricos y biotecnológicos.'],
            ['nombre' => 'Siegfried', 'descripcion' => 'Laboratorio suizo que ofrece servicios de manufactura y desarrollo de productos farmacéuticos en Colombia.'],
            ['nombre' => 'Laboratorios Laproff', 'descripcion' => 'Laboratorio colombiano especializado en medicamentos genéricos y de prescripción.'],
        ];

        foreach ($laboratorios as $laboratorio) {
            $caracteristica = Caracteristica::create([
                'nombre' => $laboratorio['nombre'],
                'descripcion' => $laboratorio['descripcion'],
            ]);

            Laboratorio::create([
                'caracteristica_id' => $caracteristica->id,
                // Agrega aquí otros campos específicos de la tabla laboratorios, si los hay
            ]);
        }
    }
}
