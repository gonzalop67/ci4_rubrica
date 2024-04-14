<?php namespace App\Database\Seeds;

use App\Models\Admin\NivelesEducacionModel;
use App\Models\Admin\PeriodosNivelesModel;
use CodeIgniter\Database\Seeder;

class NivelEducacionSeeder extends Seeder
{
	public function run()
	{
		$niveles_educacion = [
			[
				'nombre' => 'Educación General Básica Preparatoria',
				'es_bachillerato' => 0,
                'orden' => 1
			],
			[
				'nombre' => 'Educación General Básica Elemental',
				'es_bachillerato' => 0,
                'orden' => 2
			],
			[
				'nombre' => 'Educación General Básica Media',
				'es_bachillerato' => 0,
                'orden' => 3
            ],
            [
				'nombre' => 'Educación General Básica Superior',
				'es_bachillerato' => 0,
                'orden' => 4
            ],
            [
				'nombre' => 'Bachillerato General Unificado',
				'es_bachillerato' => 1,
                'orden' => 5
            ],
		];

		$nivelModel = new NivelesEducacionModel();
        $periodoNivelModel = new PeriodosNivelesModel();

        foreach ($niveles_educacion as $nivel) {
            $nivelModel->save([
                'nombre'          => $nivel['nombre'],
                'es_bachillerato' => $nivel['es_bachillerato'],
                'orden'           => $nivel['orden']
            ]);
            $id_nivel_educacion = $nivelModel->getInsertID();
            $periodoNivelModel->save([
                'id_nivel_educacion' => $id_nivel_educacion,
                'id_periodo_lectivo' => 1
            ]);
        }
	}
}
