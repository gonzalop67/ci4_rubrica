<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwNivelEducacion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_nivel_educacion'  => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '48',
			],
			'es_bachillerato' => [
				'type'       => 'INT',
				'constraint' => 1,
				'unsigned'   => true,
			],
			'orden' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
				'default'    => 0,
			],
		]);
		$this->forge->addKey('id_nivel_educacion', true);
		$this->forge->createTable('sw_nivel_educacion');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_nivel_educacion');
	}
}
