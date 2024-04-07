<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwAsignatura extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_asignatura' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_area' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_tipo_asignatura' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'as_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '84',
			],
			'as_abreviatura' => [
				'type'       => 'VARCHAR',
				'constraint' => '12',
			],
			'as_shortname' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'as_curricular' => [
				'type'       => 'INT',
				'constraint' => 1,
				'unsigned'   => true,
				'default'    => 1,
			],			
		]);
		$this->forge->addKey('id_asignatura', true);
		$this->forge->addForeignKey('id_area','sw_area','id_area');
		$this->forge->addForeignKey('id_tipo_asignatura','sw_tipo_asignatura','id_tipo_asignatura');
		$this->forge->createTable('sw_asignatura');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_asignatura');
	}
}
