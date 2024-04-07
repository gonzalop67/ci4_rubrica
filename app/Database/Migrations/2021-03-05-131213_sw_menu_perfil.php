<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwMenuPerfil extends Migration
{
	public function up()
	{
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
		$this->forge->addForeignKey('id_perfil','sw_perfil','id_perfil', 'CASCADE', 'RESTRICT');
		$this->forge->addForeignKey('id_menu','sw_menu','id_menu', 'CASCADE', 'CASCADE');
		$this->forge->createTable('sw_menu_perfil');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_menu_perfil');
	}
}
