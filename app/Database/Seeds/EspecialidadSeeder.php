<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
	public function run()
	{
		$especialidades = [
			[
                'id_tipo_educacion' => 1,
				'es_nombre' => 'Primer Año',
				'es_figura' => 'Primer Año',
                'es_abreviatura' => 'Pre.',
                'es_orden' => 1
			],
			[
				'id_tipo_educacion' => 2,
				'es_nombre' => 'EGB ELEMENTAL',
				'es_figura' => 'EGB ELEMENTAL',
                'es_abreviatura' => 'EGB. 2-3-4',
                'es_orden' => 2
			],
			[
				'id_tipo_educacion' => 3,
				'es_nombre' => 'EGB MEDIA',
				'es_figura' => 'EGB MEDIA',
                'es_abreviatura' => 'EGB. 5-6-7',
                'es_orden' => 3
            ],
            [
				'id_tipo_educacion' => 4,
				'es_nombre' => 'EGB SUPERIOR',
				'es_figura' => 'EDUCACION GENERAL BASICA SUPERIOR',
                'es_abreviatura' => 'EGBS',
                'es_orden' => 4
            ],
            [
				'id_tipo_educacion' => 5,
				'es_nombre' => 'BACHILLERATO GENERAL UNIFICADO',
				'es_figura' => 'BACHILLERATO GENERAL UNIFICADO',
                'es_abreviatura' => 'BGU',
                'es_orden' => 5
            ],
		];

		$builder = $this->db->table('sw_especialidad');
		$builder->insertBatch($especialidades);
	}
}
