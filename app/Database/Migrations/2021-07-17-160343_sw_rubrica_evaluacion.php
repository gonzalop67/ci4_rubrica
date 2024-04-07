<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwRubricaEvaluacion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_rubrica_evaluacion' => [
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
			'id_tipo_asignatura' => [
				'type'       => 'INT',
				'constraint' => 1,
				'unsigned'   => true,
				'default'    => 1,
			],
			'ru_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '24',
			],
			'ru_abreviatura' => [
				'type'       => 'VARCHAR',
				'constraint' => '6',
			],
			'ru_descripcion' => [
				'type'       => 'VARCHAR',
				'constraint' => '256',
			]
		]);
		$this->forge->addKey('id_rubrica_evaluacion', true);
		$this->forge->addForeignKey('id_aporte_evaluacion','sw_aporte_evaluacion','id_aporte_evaluacion');
		$this->forge->addForeignKey('id_tipo_asignatura','sw_tipo_asignatura','id_tipo_asignatura');
		$this->forge->createTable('sw_rubrica_evaluacion');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_rubrica_evaluacion');
	}
}
