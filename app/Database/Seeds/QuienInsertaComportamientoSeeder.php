<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuienInsertaComportamientoSeeder extends Seeder
{
    public function run()
    {
        $quien_inserta_comp = [
			[
				'nombre' => 'Tutor'
			],
			[
				'nombre' => 'Docente'
			],
		];
        $builder = $this->db->table('sw_quien_inserta_comp');
		$builder->insertBatch($quien_inserta_comp);
    }
}
