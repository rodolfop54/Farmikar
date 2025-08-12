<?php

namespace Database\Seeders;

use App\Models\Caracteristica;
use App\Models\Categoria;
use App\Models\Sintoma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SintomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sintomas = [
            ['nombre' => 'Dolor', 'descripcion' => 'Sensación de malestar o sufrimiento, que puede ser agudo o crónico.'],
            ['nombre' => 'Fiebre', 'descripcion' => 'Elevación de la temperatura corporal por encima de lo normal, generalmente asociada a infecciones.'],
            ['nombre' => 'Náuseas', 'descripcion' => 'Sensación de malestar estomacal que puede provocar el vómito.'],
            ['nombre' => 'Vómitos', 'descripcion' => 'Expulsión forzada del contenido del estómago a través de la boca.'],
            ['nombre' => 'Tos', 'descripcion' => 'Reflejo que ayuda a limpiar las vías respiratorias de mucosidad o irritantes.'],
            ['nombre' => 'Congestión nasal', 'descripcion' => 'Obstrucción de las fosas nasales debido a inflamación o acumulación de moco.'],
            ['nombre' => 'Dolor de cabeza', 'descripcion' => 'Malestar o dolor en la cabeza, que puede variar en intensidad.'],
            ['nombre' => 'Insomnio', 'descripcion' => 'Dificultad para conciliar o mantener el sueño, lo que resulta en un descanso inadecuado.'],
            ['nombre' => 'Alergias', 'descripcion' => 'Reacciones del sistema inmunológico a sustancias que generalmente son inofensivas.'],
            ['nombre' => 'Fatiga', 'descripcion' => 'Sensación de cansancio extremo o falta de energía.'],
            ['nombre' => 'Depresión', 'descripcion' => 'Trastorno del estado de ánimo que causa una persistente sensación de tristeza y pérdida de interés.'],
            ['nombre' => 'Ansiedad', 'descripcion' => 'Estado de preocupación, nerviosismo o temor que puede afectar el bienestar.'],
            ['nombre' => 'Acidez estomacal', 'descripcion' => 'Sensación de ardor en el pecho o la garganta causada por el reflujo ácido.'],
            ['nombre' => 'Diarrea', 'descripcion' => 'Aumento en la frecuencia y fluidez de las deposiciones.'],
            ['nombre' => 'Estreñimiento', 'descripcion' => 'Dificultad para evacuar o disminución en la frecuencia de las deposiciones.'],
            ['nombre' => 'Picazón', 'descripcion' => 'Sensación incómoda en la piel que provoca el deseo de rascarse.'],
            ['nombre' => 'Erucciones cutáneas', 'descripcion' => 'Cambios en la piel que pueden incluir enrojecimiento, hinchazón o irritación.'],
            ['nombre' => 'Dolor de estómago', 'descripcion' => 'Malestar en la región abdominal que puede tener múltiples causas.'],
            ['nombre' => 'Dolor muscular', 'descripcion' => 'Malestar o dolor en los músculos, que puede ser agudo o crónico.'],
            ['nombre' => 'Cansancio', 'descripcion' => 'Sensación de agotamiento físico o mental.'],
            ['nombre' => 'Sibilancias', 'descripcion' => 'Sonidos silbantes al respirar, que pueden indicar problemas respiratorios.'],
            ['nombre' => 'Malestar general', 'descripcion' => 'Sensación de indisposición o enfermedad sin un síntoma específico.'],
            ['nombre' => 'Inflamación', 'descripcion' => 'Reacción del cuerpo a lesiones o infecciones que provoca hinchazón y dolor.'],
            ['nombre' => 'Palpitaciones', 'descripcion' => 'Sensación de latidos cardíacos rápidos o irregulares.'],
            ['nombre' => 'Dolor en las articulaciones', 'descripcion' => 'Malestar o dolor en las uniones entre huesos, que puede ser resultado de diversas condiciones.'],
            ['nombre' => 'Estornudos', 'descripcion' => 'Expulsión involuntaria de aire a través de la nariz y la boca, a menudo como respuesta a irritantes.'],
            ['nombre' => 'Dolor de garganta', 'descripcion' => 'Malestar o dolor en la garganta, que puede ser causado por infecciones o irritación.'],
            ['nombre' => 'Dolores menstruales', 'descripcion' => 'Malestar o dolor en la parte inferior del abdomen durante la menstruación.'],
            ['nombre' => 'Sudoración excesiva', 'descripcion' => 'Producción anormalmente alta de sudor, que puede ser un síntoma de diversas condiciones.'],
            ['nombre' => 'Dificultad para respirar', 'descripcion' => 'Sensación de no poder obtener suficiente aire, lo que puede ser sintoma de diversas afecciones.'],
            // Agrega más categorías según sea necesario
        ];

        foreach ($sintomas as $sintoma) {
            $caracteristica = Caracteristica::create([
                'nombre' => $sintoma['nombre'],
                'descripcion' => $sintoma['descripcion'],
            ]);

            Sintoma::create([
                'caracteristica_id' => $caracteristica->id,
                // Agrega aquí otros campos específicos de la tabla categorias, si los hay
            ]);
        }
        
    }
}
