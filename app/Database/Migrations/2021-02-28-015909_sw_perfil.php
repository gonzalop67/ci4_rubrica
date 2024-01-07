<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwPerfil extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_perfil' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'pe_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '16',
			],
		]);
		$this->forge->addKey('id_perfil', true);
		$this->forge->createTable('sw_perfil');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_perfil');
	}
}
