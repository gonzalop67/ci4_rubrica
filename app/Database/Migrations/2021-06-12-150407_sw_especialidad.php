<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwEspecialidad extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_especialidad' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_nivel_educacion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'es_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'es_figura' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'es_abreviatura' => [
				'type'       => 'VARCHAR',
				'constraint' => '15',
			],
			'es_orden' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
				'default'    => 0,
			],
		]);
		$this->forge->addKey('id_especialidad', true);
		$this->forge->addForeignKey('id_nivel_educacion','sw_nivel_educacion','id_nivel_educacion');
		$this->forge->createTable('sw_especialidad');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_especialidad');
	}
}
