<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwMallaCurricular extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_malla_curricular' => [
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
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_asignatura' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'ma_horas_presenciales' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'ma_horas_autonomas' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'ma_horas_tutorias'  => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'ma_subtotal' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_malla_curricular', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_curso','sw_curso','id_curso');
		$this->forge->addForeignKey('id_asignatura','sw_asignatura','id_asignatura');
		$this->forge->createTable('sw_malla_curricular');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_malla_curricular');
	}
}
