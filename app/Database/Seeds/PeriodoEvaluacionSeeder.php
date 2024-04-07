<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeriodoEvaluacionSeeder extends Seeder
{
	public function run()
	{
		//ESTE SEEDER DEBE EJECUTARSE LUEGO DEL SEEDER PARA
		//TIPOS DE PERIODO
		$periodos_evaluacion = [
			[
				'pe_nombre'       => 'PRIMER TRIMESTRE', 
                'pe_abreviatura'  => '1ER.T.',
                'id_tipo_periodo' => 1,
				'id_periodo_lectivo' => 1,
				'pe_ponderacion' => 0.3,
				'pe_orden' => 1
			],
			[
				'pe_nombre'       => 'SEGUNDO TRIMESTRE', 
                'pe_abreviatura'  => '2DO.T.',
                'id_tipo_periodo' => 1,
				'id_periodo_lectivo' => 1,
				'pe_ponderacion' => 0.3,
				'pe_orden' => 2
			],
			[
				'pe_nombre'       => 'TERCER TRIMESTRE', 
                'pe_abreviatura'  => '3ER.T.',
                'id_tipo_periodo' => 1,
				'id_periodo_lectivo' => 1,
				'pe_ponderacion' => 0.3,
				'pe_orden' => 3
			],
			[
				'pe_nombre'       => 'PROYECTO INTEGRADOR', 
                'pe_abreviatura'  => 'PRI',
                'id_tipo_periodo' => 6,
				'id_periodo_lectivo' => 1,
				'pe_ponderacion' => 0.1,
				'pe_orden' => 4
			],
			[
				'pe_nombre'       => 'EXAMEN SUPLETORIO', 
                'pe_abreviatura'  => 'SUP.',
                'id_tipo_periodo' => 2,
				'id_periodo_lectivo' => 1,
				'pe_ponderacion' => 0,
				'pe_orden' => 5
			],
		];
        $builder = $this->db->table('sw_periodo_evaluacion');
		$builder->insertBatch($periodos_evaluacion);
	}
}
