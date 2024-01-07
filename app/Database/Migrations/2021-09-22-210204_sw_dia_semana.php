<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwDiaSemana extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_dia_semana'    => [
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
			'ds_nombre'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
			],
			'ds_ordinal'         => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_dia_semana', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->createTable('sw_dia_semana');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_dia_semana');
	}
}
