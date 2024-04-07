<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiaSemanaSeeder extends Seeder
{
    public function run()
    {
        $dias_semana = [
            [
                'id_periodo_lectivo' => 1,
                'ds_nombre'          => 'LUNES',
                'ds_ordinal'         => 1
            ],
            [
                'id_periodo_lectivo' => 1,
                'ds_nombre'          => 'MARTES',
                'ds_ordinal'         => 2
            ],
            [
                'id_periodo_lectivo' => 1,
                'ds_nombre'          => 'MIERCOLES',
                'ds_ordinal'         => 3
            ],
            [
                'id_periodo_lectivo' => 1,
                'ds_nombre'          => 'JUEVES',
                'ds_ordinal'         => 4
            ],
            [
                'id_periodo_lectivo' => 1,
                'ds_nombre'          => 'VIERNES',
                'ds_ordinal'         => 5
            ],
        ];

        $builder = $this->db->table('sw_dia_semana');
        $builder->insertBatch($dias_semana);
    }
}
