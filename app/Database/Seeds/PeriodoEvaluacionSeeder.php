<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Admin\SubPeriodosEvaluacionModel;
use App\Models\Admin\subPeriodosPeriodoModel;

class PeriodoEvaluacionSeeder extends Seeder
{
	public function run()
	{
		//ESTE SEEDER DEBE EJECUTARSE LUEGO DEL SEEDER PARA
		//TIPOS DE PERIODO
		$sub_periodos_evaluacion = [
			[
				'pe_nombre'       => 'PRIMER TRIMESTRE', 
                'pe_abreviatura'  => '1ER.T.',
                'id_tipo_periodo' => 1,
				'pe_ponderacion' => 0.3,
				'pe_orden' => 1
			],
			[
				'pe_nombre'       => 'SEGUNDO TRIMESTRE', 
                'pe_abreviatura'  => '2DO.T.',
                'id_tipo_periodo' => 1,
				'pe_ponderacion' => 0.3,
				'pe_orden' => 2
			],
			[
				'pe_nombre'       => 'TERCER TRIMESTRE', 
                'pe_abreviatura'  => '3ER.T.',
                'id_tipo_periodo' => 1,
				'pe_ponderacion' => 0.3,
				'pe_orden' => 3
			],
			[
				'pe_nombre'       => 'PROYECTO INTEGRADOR', 
                'pe_abreviatura'  => 'PRI',
                'id_tipo_periodo' => 6,
				'pe_ponderacion' => 0.1,
				'pe_orden' => 4
			],
			[
				'pe_nombre'       => 'EXAMEN SUPLETORIO', 
                'pe_abreviatura'  => 'SUP.',
                'id_tipo_periodo' => 2,
				'pe_ponderacion' => 0,
				'pe_orden' => 5
			],
		];
        // $builder = $this->db->table('sw_sub_periodo_evaluacion');
		// $builder->insertBatch($sub_periodos_evaluacion);

		$subPeriodoModel = new SubPeriodosEvaluacionModel();
        $subPeriodoPeriodoModel = new subPeriodosPeriodoModel();

        foreach ($sub_periodos_evaluacion as $sub_periodo) {
            $subPeriodoModel->save([
                'pe_nombre'       => $sub_periodo['pe_nombre'],
                'pe_abreviatura'  => $sub_periodo['pe_abreviatura'],
                'id_tipo_periodo' => $sub_periodo['id_tipo_periodo'],
                'pe_ponderacion'  => $sub_periodo['pe_ponderacion'],
                'pe_orden'        => $sub_periodo['pe_orden']
            ]);
            $id_sub_periodo_evaluacion = $subPeriodoModel->getInsertID();
            $subPeriodoPeriodoModel->save([
                'id_sub_periodo_evaluacion' => $id_sub_periodo_evaluacion,
                'id_periodo_lectivo'         => 1
            ]);
        }
	}
}
