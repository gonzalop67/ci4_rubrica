<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefGeneroSeeder extends Seeder
{
	public function run()
	{
		$def_generos = [
			[
				'dg_nombre'       => 'FEMENINO', 
                'dg_abreviatura'  => 'F'
			],
			[
				'dg_nombre'       => 'MASCULINO', 
                'dg_abreviatura'  => 'M'
			],
		];
        $builder = $this->db->table('sw_def_genero');
		$builder->insertBatch($def_generos);
	}
}
