<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EscalaCalificacionesSeeder extends Seeder
{
	public function run()
	{
		$escalas = [
			[
                'id_periodo_lectivo' => 1,
				'ec_cualitativa' => 'Domina los aprendizajes requeridos',
				'ec_cuantitativa' => '9.00 - 10.00',
                'ec_nota_minima' => 9,
                'ec_nota_maxima' => 10,
                'ec_orden' => 1,
                'ec_equivalencia' => 'DA'
			],
			[
                'id_periodo_lectivo' => 1,
				'ec_cualitativa' => 'Alcanza los aprendizajes requeridos',
				'ec_cuantitativa' => '7.00 - 8.99',
                'ec_nota_minima' => 7,
                'ec_nota_maxima' => 8.99,
                'ec_orden' => 2,
                'ec_equivalencia' => 'AA'
			],
			[
                'id_periodo_lectivo' => 1,
				'ec_cualitativa' => 'Está próximo a alcanzar los aprendizajes requeridos',
				'ec_cuantitativa' => '4.01 - 6.99',
                'ec_nota_minima' => 4.01,
                'ec_nota_maxima' => 6.99,
                'ec_orden' => 3,
                'ec_equivalencia' => 'EA'
			],
            [
                'id_periodo_lectivo' => 1,
				'ec_cualitativa' => 'No alcanza los aprendizajes requeridos',
				'ec_cuantitativa' => '<= 4',
                'ec_nota_minima' => 0,
                'ec_nota_maxima' => 4,
                'ec_orden' => 4,
                'ec_equivalencia' => 'NA'
			],
		];

		$builder = $this->db->table('sw_escala_calificaciones');
		$builder->insertBatch($escalas);
	}
}
