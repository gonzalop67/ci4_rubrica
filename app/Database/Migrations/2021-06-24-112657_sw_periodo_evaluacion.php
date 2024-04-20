<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwPeriodoEvaluacion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_periodo_evaluacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_periodo_lectivo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
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
		$this->forge->addKey('id_periodo_evaluacion', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_tipo_periodo','sw_tipo_periodo','id_tipo_periodo');
		$this->forge->createTable('sw_periodo_evaluacion');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_periodo_evaluacion');
	}
}
