<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwDefGenero extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_def_genero' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'dg_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'dg_abreviatura' => [
				'type'       => 'VARCHAR',
				'constraint' => '1',
			],
		]);
		$this->forge->addKey('id_def_genero', true);
		$this->forge->createTable('sw_def_genero');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_def_genero');
	}
}
