<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwParaleloInspector extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_paralelo_inspector' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_periodo_lectivo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_paralelo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_usuario' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_paralelo_inspector', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_paralelo','sw_paralelo','id_paralelo');
		$this->forge->addForeignKey('id_usuario','sw_usuario','id_usuario');
		$this->forge->createTable('sw_paralelo_inspector');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_paralelo_inspector');
	}
}
