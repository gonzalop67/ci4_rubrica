<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwDistributivo extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_distributivo'    => [
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
			'id_malla_curricular' => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'id_paralelo'        => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_asignatura'      => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_usuario'         => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_distributivo', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_malla_curricular','sw_malla_curricular','id_malla_curricular');
		$this->forge->addForeignKey('id_paralelo','sw_paralelo','id_paralelo');
		$this->forge->addForeignKey('id_asignatura','sw_asignatura','id_asignatura');
		$this->forge->addForeignKey('id_usuario','sw_usuario','id_usuario');
		$this->forge->createTable('sw_distributivo');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_distributivo');
	}
}
