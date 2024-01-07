<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NivelEducacionSeeder extends Seeder
{
	public function run()
	{
		$niveles_educacion = [
			[
				'id_periodo_lectivo' => 1,
				'te_nombre' => 'Educación General Básica Preparatoria',
				'te_bachillerato' => 0,
                'te_orden' => 1
			],
			[
				'id_periodo_lectivo' => 1,
				'te_nombre' => 'Educación General Básica Elemental',
				'te_bachillerato' => 0,
                'te_orden' => 2
			],
			[
				'id_periodo_lectivo' => 1,
				'te_nombre' => 'Educación General Básica Media',
				'te_bachillerato' => 0,
                'te_orden' => 3
            ],
            [
				'id_periodo_lectivo' => 1,
				'te_nombre' => 'Educación General Básica Superior',
				'te_bachillerato' => 0,
                'te_orden' => 4
            ],
            [
				'id_periodo_lectivo' => 1,
				'te_nombre' => 'Bachillerato General Unificado',
				'te_bachillerato' => 1,
                'te_orden' => 5
            ],
		];

		$builder = $this->db->table('sw_tipo_educacion');
		$builder->insertBatch($niveles_educacion);
	}
}
