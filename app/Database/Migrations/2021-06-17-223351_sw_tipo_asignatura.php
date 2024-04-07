<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwTipoAsignatura extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tipo_asignatura' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'ta_descripcion' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
		]);
		$this->forge->addKey('id_tipo_asignatura', true);
		$this->forge->createTable('sw_tipo_asignatura');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_tipo_asignatura');
	}
}
