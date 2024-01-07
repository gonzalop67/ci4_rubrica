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
				'pe_nombre'       => 'PRIMER QUIMESTRE', 
                'pe_abreviatura'  => '1ER.Q.',
                'id_tipo_periodo' => 1,
				'id_periodo_lectivo' => 1
			],
			[
				'pe_nombre'       => 'SEGUNDO QUIMESTRE', 
                'pe_abreviatura'  => '2DO.Q.',
                'id_tipo_periodo' => 1,
				'id_periodo_lectivo' => 1
			],
			[
				'pe_nombre'       => 'EXAMEN SUPLETORIO', 
                'pe_abreviatura'  => 'SUP.',
                'id_tipo_periodo' => 2,
				'id_periodo_lectivo' => 1
			],
			[
				'pe_nombre'       => 'EXAMEN REMEDIAL', 
                'pe_abreviatura'  => 'REM.',
                'id_tipo_periodo' => 3,
				'id_periodo_lectivo' => 1
			],
			[
				'pe_nombre'       => 'EXAMEN DE GRACIA', 
                'pe_abreviatura'  => 'GRA.',
                'id_tipo_periodo' => 4,
				'id_periodo_lectivo' => 1
			],
		];
        $builder = $this->db->table('sw_periodo_evaluacion');
		$builder->insertBatch($periodos_evaluacion);
	}
}
