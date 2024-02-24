<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Carbon\Carbon;

class PrimerPeriodoLectivoSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'id_periodo_estado'  => '1',
			'id_modalidad'       => 1,
			'pe_anio_inicio'     => date("Y"),
			'pe_anio_fin'        => date("Y") + 1,
			'pe_fecha_inicio'    => Carbon::now(),
			'pe_fecha_fin'       => Carbon::now(),
			'pe_nota_minima'     => 4.01,
			'pe_nota_aprobacion' => 7
		];

		// Using Query Builder
		$this->db->table('sw_periodo_lectivo')->insert($data);
	}
}
