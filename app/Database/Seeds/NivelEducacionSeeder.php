<?php namespace App\Database\Seeds;

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

		$builder = $this->db->table('sw_nivel_educacion');
		$builder->insertBatch($niveles_educacion);
	}
}
