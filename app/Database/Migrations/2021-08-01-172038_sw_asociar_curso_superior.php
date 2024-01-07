<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwAsociarCursoSuperior extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_asociar_curso_superior' => [
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
			'id_curso_inferior' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_curso_superior' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_asociar_curso_superior', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_curso_inferior','sw_curso','id_curso');
		$this->forge->addForeignKey('id_curso_superior','sw_curso','id_curso');
		$this->forge->createTable('sw_asociar_curso_superior');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_asociar_curso_superior');
	}
}
