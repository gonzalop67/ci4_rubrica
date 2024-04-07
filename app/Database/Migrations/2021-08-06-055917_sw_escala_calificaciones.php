<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwEscalaCalificaciones extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_escala_calificaciones' => [
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
			'ec_cualitativa' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'ec_cuantitativa' => [
				'type'       => 'VARCHAR',
				'constraint' => '16',
			],
			'ec_nota_minima' => [
				'type'       => 'FLOAT',
			],
			'ec_nota_maxima' => [
				'type'       => 'FLOAT',
			],
			'ec_orden' => [
				'type'       => 'INT',
				'constraint' => '4',
			],
			'ec_equivalencia' => [
				'type'       => 'VARCHAR',
				'constraint' => '2',
			],
		]);
		$this->forge->addKey('id_escala_calificaciones', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->createTable('sw_escala_calificaciones');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_escala_calificaciones');
	}
}
