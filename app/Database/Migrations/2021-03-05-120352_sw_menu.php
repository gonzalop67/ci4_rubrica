<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwMenu extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_menu' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'mnu_texto' => [
				'type'       => 'VARCHAR',
				'constraint' => '32',
			],
			'mnu_link' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'mnu_nivel' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'mnu_orden' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'default'        => 0
			],
			'mnu_padre' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'default'        => 0
			],
			'mnu_publicado' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'mnu_icono' => [
				'type'       => 'VARCHAR',
				'constraint' => '32',
			],
		]);
		$this->forge->addKey('id_menu', true);
		$this->forge->createTable('sw_menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_menu');
	}
}
