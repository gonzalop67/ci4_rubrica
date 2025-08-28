<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwPeriodoNivel extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_periodo_lectivo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_nivel_educacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_periodo_nivel', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_nivel_educacion','sw_nivel_educacion','id_nivel_educacion');
		$this->forge->createTable('sw_periodo_nivel');
    }

    public function down()
    {
        $this->forge->dropTable('sw_periodo_nivel');
    }
}
