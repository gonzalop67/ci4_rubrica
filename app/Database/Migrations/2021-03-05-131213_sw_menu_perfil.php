<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwMenuPerfil extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField([
			'id_perfil' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_menu' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addForeignKey('id_perfil','sw_perfil','id_perfil');
		$this->forge->addForeignKey('id_menu','sw_menu','id_menu');
		$this->forge->createTable('sw_menu_perfil');
		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_menu_perfil');
	}
}
