<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModalidadSeeder extends Seeder
{
	public function run()
	{
		$modalidades = [
			[
				'mo_nombre' => 'EGB SUPERIOR INTENSIVA',
				'mo_activo' => 1,
				'mo_orden'  => 1
			],
			[
				'mo_nombre' => 'BGU INTENSIVO',
				'mo_activo' => 1,
				'mo_orden'  => 2
			],
			[
				'mo_nombre' => 'SEMIPRESENCIAL',
				'mo_activo' => 1,
				'mo_orden'  => 3
			]
		];

		$builder = $this->db->table('sw_modalidad');
		$builder->insertBatch($modalidades);
	}
}
