<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwDefNacionalidad extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_def_nacionalidad' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'dn_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
		]);
		$this->forge->addKey('id_def_nacionalidad', true);
		$this->forge->createTable('sw_def_nacionalidad');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_def_nacionalidad');
	}
}
