<?php

namespace Database\Seeders;

use App\Models\Caracteristica;
use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Tipo::factory()->count(2)->create(); */

        $tipos = [
            ['nombre' => 'Analgésico', 'descripcion' => 'Medicamentos que alivian el dolor.'],
            ['nombre' => 'Antiinflamatorio', 'descripcion' => 'Medicamentos que reducen la inflamación.'],
            ['nombre' => 'Antibiótico', 'descripcion' => 'Medicamentos que eliminan o inhiben el crecimiento de bacterias.'],
            ['nombre' => 'Antihistamínico', 'descripcion' => 'Medicamentos que alivian reacciones alérgicas.'],
            ['nombre' => 'Antipirético', 'descripcion' => 'Medicamentos que reducen la fiebre.'],
            ['nombre' => 'Antidepresivo', 'descripcion' => 'Medicamentos que tratan la depresión.'],
            ['nombre' => 'Anticonvulsivo', 'descripcion' => 'Medicamentos que previenen o tratan las convulsiones.'],
            ['nombre' => 'Diurético', 'descripcion' => 'Medicamentos que ayudan a eliminar el exceso de líquidos del cuerpo.'],
            ['nombre' => 'Broncodilatador', 'descripcion' => 'Medicamentos que ensanchan las vías respiratorias.'],
            ['nombre' => 'Anticoagulante', 'descripcion' => 'Medicamentos que previenen la formación de coágulos sanguíneos.'],
            ['nombre' => 'Antifúngico', 'descripcion' => 'Medicamentos que eliminan o inhiben el crecimiento de hongos.'],
            ['nombre' => 'Antipsicótico', 'descripcion' => 'Medicamentos que tratan trastornos psicóticos.'],
            ['nombre' => 'Hipoglucemiante', 'descripcion' => 'Medicamentos que reducen los niveles de glucosa en la sangre.'],
            ['nombre' => 'Anestésico', 'descripcion' => 'Medicamentos que inducen insensibilidad o pérdida de conciencia.'],
            ['nombre' => 'Antiviral', 'descripcion' => 'Medicamentos que combaten infecciones virales.'],
            ['nombre' => 'Inmunosupresor', 'descripcion' => 'Medicamentos que suprimen la respuesta inmunitaria.'],
            ['nombre' => 'Laxante', 'descripcion' => 'Medicamentos que facilitan el tránsito intestinal.'],
            ['nombre' => 'Antiparasitario', 'descripcion' => 'Medicamentos que eliminan o inhiben parásitos.'],
            ['nombre' => 'Antiespasmódico', 'descripcion' => 'Medicamentos que alivian espasmos musculares.'],
            ['nombre' => 'Expectorante', 'descripcion' => 'Medicamentos que ayudan a expulsar mucosidades.'],
            ['nombre' => 'Mucolítico', 'descripcion' => 'Medicamentos que disuelven la mucosidad.'],
            ['nombre' => 'Hipnótico', 'descripcion' => 'Medicamentos que inducen el sueño.'],
            ['nombre' => 'Sedante', 'descripcion' => 'Medicamentos que calman o reducen la excitación nerviosa.'],
            ['nombre' => 'Antiemético', 'descripcion' => 'Medicamentos que previenen o alivian el vómito y las náuseas.'],
            ['nombre' => 'Antiácido', 'descripcion' => 'Medicamentos que neutralizan el ácido estomacal.'],
            ['nombre' => 'Antidiarreico', 'descripcion' => 'Medicamentos que reducen la diarrea.'],
            ['nombre' => 'Antitusivo', 'descripcion' => 'Medicamentos que reducen la tos.'],
            ['nombre' => 'Anticolinérgico', 'descripcion' => 'Medicamentos que bloquean la acción de la acetilcolina en el sistema nervioso.'],
            ['nombre' => 'Antiepiléptico', 'descripcion' => 'Medicamentos que previenen crisis epilépticas.'],
            ['nombre' => 'Antioxidante', 'descripcion' => 'Sustancias que previenen el daño oxidativo en las células.'],
            ['nombre' => 'Antimicótico', 'descripcion' => 'Medicamentos que tratan infecciones causadas por hongos.'],
            ['nombre' => 'Antagonista del calcio', 'descripcion' => 'Medicamentos que disminuyen la entrada de calcio a las células cardíacas y vasos sanguíneos.'],
            ['nombre' => 'Betabloqueante', 'descripcion' => 'Medicamentos que reducen la presión arterial al bloquear los receptores beta en el corazón.'],
            ['nombre' => 'Vasodilatador', 'descripcion' => 'Medicamentos que dilatan los vasos sanguíneos.'],
            ['nombre' => 'Estatinas', 'descripcion' => 'Medicamentos que reducen los niveles de colesterol.'],
            ['nombre' => 'Corticoesteroide', 'descripcion' => 'Medicamentos que reducen la inflamación y suprimen la respuesta inmunitaria.'],
            ['nombre' => 'Anticonceptivo', 'descripcion' => 'Medicamentos que previenen el embarazo.'],
            ['nombre' => 'Terapia de reemplazo hormonal', 'descripcion' => 'Medicamentos que reemplazan hormonas en el cuerpo.'],
            ['nombre' => 'Antineoplásico', 'descripcion' => 'Medicamentos que tratan el cáncer.'],
            ['nombre' => 'Quimioterápico', 'descripcion' => 'Medicamentos utilizados en el tratamiento del cáncer.'],
            ['nombre' => 'Antiagregante plaquetario', 'descripcion' => 'Medicamentos que previenen la formación de coágulos sanguíneos al inhibir la agregación de plaquetas.'],
            ['nombre' => 'Antiestrogénico', 'descripcion' => 'Medicamentos que bloquean los efectos de los estrógenos.'],
            ['nombre' => 'Antirretroviral', 'descripcion' => 'Medicamentos que tratan infecciones por retrovirus, como el VIH.'],
        ];
        

        foreach ($tipos as $tipo) {
            $caracteristica = Caracteristica::create([
                'nombre' => $tipo['nombre'],
                'descripcion' => $tipo['descripcion'],
            ]);

            Tipo::create([
                'caracteristica_id' => $caracteristica->id,
                // Agrega aquí otros campos específicos de la tabla tipos, si los hay
            ]);
        }
    }
}
