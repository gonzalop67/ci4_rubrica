<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwPeriodoLectivo extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField([
			'id_periodo_lectivo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_periodo_estado' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_modalidad' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'pe_anio_inicio' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'pe_anio_fin' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'pe_fecha_inicio' => [
				'type'           => 'DATE',
			],
			'pe_fecha_fin' => [
				'type'           => 'DATE',
			],
			'pe_nota_minima' => [
				'type' => 'FLOAT'
			],
			'pe_nota_aprobacion' => [
				'type' => 'FLOAT'
			],
			'quien_inserta_comp_id' => [
				'type'       => 'INT',
				'constraint' => 1,
				'unsigned'   => true,
				'default'    => 1,
			],
		]);
		$this->forge->addKey('id_periodo_lectivo', true);
		$this->forge->addForeignKey('id_periodo_estado','sw_periodo_estado','id_periodo_estado');
		$this->forge->addForeignKey('id_modalidad','sw_modalidad','id_modalidad');
		$this->forge->addForeignKey('quien_inserta_comp_id','sw_quien_inserta_comp','id');
		$this->forge->createTable('sw_periodo_lectivo');
		$this->db->enableForeignKeyChecks();
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_periodo_lectivo');
	}
}
