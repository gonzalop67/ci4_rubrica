<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeriodoEstadoSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'pe_descripcion' => 'ACTUAL',
		];
	
		// Using Query Builder
		$this->db->table('sw_periodo_estado')->insert($data);

		$data = [
			'pe_descripcion' => 'TERMINADO',
		];
	
		// Using Query Builder
		$this->db->table('sw_periodo_estado')->insert($data);
	}
}
