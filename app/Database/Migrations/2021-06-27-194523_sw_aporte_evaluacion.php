<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwAporteEvaluacion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_aporte_evaluacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_periodo_evaluacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_tipo_aporte' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'ap_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '48',
			],
			'ap_descripcion' => [
				'type'       => 'VARCHAR',
				'constraint' => '256',
			],
			'ap_abreviatura' => [
				'type'       => 'VARCHAR',
				'constraint' => '8',
			],
			'ap_fecha_apertura' => [
				'type'          => 'DATE',
			],
			'ap_fecha_cierre' => [
				'type'        => 'DATE',
			],
			'ap_ponderacion' => [
				'type'       => 'FLOAT'
			],
			'ap_orden' => [
				'type' => 'INT',
				'constraint' => 4
			]
		]);
		$this->forge->addKey('id_aporte_evaluacion', true);
		$this->forge->addForeignKey('id_periodo_evaluacion','sw_periodo_evaluacion','id_periodo_evaluacion');
		$this->forge->addForeignKey('id_tipo_aporte','sw_tipo_aporte','id_tipo_aporte');
		$this->forge->createTable('sw_aporte_evaluacion');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_aporte_evaluacion');
	}
}
