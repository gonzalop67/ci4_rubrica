<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwJornada extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_jornada' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jo_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '16',
			],
		]);
		$this->forge->addKey('id_jornada', true);
		$this->forge->createTable('sw_jornada');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_jornada');
	}
}
