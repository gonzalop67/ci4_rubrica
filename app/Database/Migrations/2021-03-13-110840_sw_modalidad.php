<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwModalidad extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_modalidad' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'mo_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'mo_activo' => [
				'type'           => 'TINYINT',
				'constraint'     => 1,
				'unsigned'       => true,
			],
			'mo_orden' => [
				'type'           => 'INT',
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_modalidad', true);
		$this->forge->createTable('sw_modalidad');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_modalidad');
	}
}
