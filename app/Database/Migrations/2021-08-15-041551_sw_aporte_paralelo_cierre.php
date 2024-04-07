<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwAporteParaleloCierre extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_aporte_paralelo_cierre' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_aporte_evaluacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_paralelo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'ap_fecha_apertura' => [
				'type'           => 'DATE',
			],
			'ap_fecha_cierre' => [
				'type'           => 'DATE',
			],
			'ap_estado' => [
				'type'       => 'VARCHAR',
				'constraint' => '1',
			],
		]);
		$this->forge->addKey('id_aporte_paralelo_cierre', true);
		$this->forge->addForeignKey('id_aporte_evaluacion','sw_aporte_evaluacion','id_aporte_evaluacion');
		$this->forge->addForeignKey('id_paralelo','sw_paralelo','id_paralelo');
		$this->forge->createTable('sw_aporte_paralelo_cierre');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_aporte_paralelo_cierre');
	}
}
