<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwAsignaturaCurso extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_asignatura_curso' => [
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
			'id_curso' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_asignatura' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'ac_orden' => [
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_asignatura_curso', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_curso','sw_curso','id_curso');
		$this->forge->addForeignKey('id_asignatura','sw_asignatura','id_asignatura');
		$this->forge->createTable('sw_asignatura_curso');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_asignatura_curso');
	}
}
