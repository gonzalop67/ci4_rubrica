<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwArea extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_area' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'ar_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
		]);
		$this->forge->addKey('id_area', true);
		$this->forge->createTable('sw_area');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_area');
	}
}
