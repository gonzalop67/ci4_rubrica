<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwUsuarioPerfil extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField([
			'id_usuario' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_perfil' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addForeignKey('id_usuario','sw_usuario','id_usuario');
		$this->forge->addForeignKey('id_perfil','sw_perfil','id_perfil');
		$this->forge->createTable('sw_usuario_perfil');
		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_usuario_perfil');
	}
}
