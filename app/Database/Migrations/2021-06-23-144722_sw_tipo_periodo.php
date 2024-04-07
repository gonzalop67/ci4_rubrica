<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwTipoPeriodo extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tipo_periodo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tp_descripcion' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
		]);
		$this->forge->addKey('id_tipo_periodo', true);
		$this->forge->createTable('sw_tipo_periodo');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_tipo_periodo');
	}
}
