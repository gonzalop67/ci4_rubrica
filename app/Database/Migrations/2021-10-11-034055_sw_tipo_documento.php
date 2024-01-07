<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwTipoDocumento extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tipo_documento' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'td_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
		]);
		$this->forge->addKey('id_tipo_documento', true);
		$this->forge->createTable('sw_tipo_documento');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_tipo_documento');
	}
}
