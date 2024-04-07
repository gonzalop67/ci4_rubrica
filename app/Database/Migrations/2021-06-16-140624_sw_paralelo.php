<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwParalelo extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_paralelo' => [
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
			'id_curso' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
			],
			'id_jornada' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
			],
			'pa_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '5',
			],
			'pa_orden' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
				'default'    => 0,
			],			
		]);
		$this->forge->addKey('id_paralelo', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_curso','sw_curso','id_curso');
		$this->forge->addForeignKey('id_jornada','sw_jornada','id_jornada');
		$this->forge->createTable('sw_paralelo');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_paralelo');
	}
}
