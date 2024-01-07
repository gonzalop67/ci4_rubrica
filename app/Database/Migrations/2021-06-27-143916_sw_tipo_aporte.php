<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwTipoAporte extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tipo_aporte' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'ta_descripcion' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
		]);
		$this->forge->addKey('id_tipo_aporte', true);
		$this->forge->createTable('sw_tipo_aporte');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_tipo_aporte');
	}
}
