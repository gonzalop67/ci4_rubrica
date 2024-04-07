<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwPeriodoEstado extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_periodo_estado' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'pe_descripcion' => [
				'type'       => 'VARCHAR',
				'constraint' => '16',
			],
		]);
		$this->forge->addKey('id_periodo_estado', true);
		$this->forge->createTable('sw_periodo_estado');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_periodo_estado');
	}
}
