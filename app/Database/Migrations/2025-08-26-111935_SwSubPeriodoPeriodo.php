<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwSubPeriodoPeriodo extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_periodo_lectivo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_sub_periodo_evaluacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo', 'RESTRICT', 'RESTRICT');
		$this->forge->addForeignKey('id_sub_periodo_evaluacion','sw_sub_periodo_evaluacion','id_sub_periodo_evaluacion', 'RESTRICT', 'RESTRICT');
		$this->forge->createTable('sw_periodo_lectivo_sub_periodo');
    }

    public function down()
    {
        $this->forge->dropTable('sw_periodo_lectivo_sub_periodo');
    }
}
