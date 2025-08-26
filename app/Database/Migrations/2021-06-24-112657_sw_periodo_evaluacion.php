<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwPeriodoEvaluacion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_sub_periodo_evaluacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_tipo_periodo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'pe_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '48',
			],
			'pe_abreviatura' => [
				'type'       => 'VARCHAR',
				'constraint' => '8',
			],
			'pe_ponderacion' => [
				'type'       => 'FLOAT'
			],
			'pe_orden' => [
				'type'           => 'INT',
				'constraint'     => 2,
				'unsigned'       => true,
			]
		]);
		$this->forge->addKey('id_sub_periodo_evaluacion', true);
		$this->forge->addForeignKey('id_tipo_periodo','sw_tipo_periodo','id_tipo_periodo');
		$this->forge->createTable('sw_sub_periodo_evaluacion');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_sub_periodo_evaluacion');
	}
}
