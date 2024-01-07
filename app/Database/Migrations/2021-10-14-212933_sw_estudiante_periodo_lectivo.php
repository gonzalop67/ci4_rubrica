<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwEstudiantePeriodoLectivo extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_estudiante_periodo_lectivo' => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
				'auto_increment'  => true,
			],
			'id_estudiante'   => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'id_periodo_lectivo'  => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'id_paralelo'         => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'es_estado'           => [
				'type'            => 'CHAR',
				'constraint'      => '1',
			],
			'es_retirado'         => [
				'type'            => 'VARCHAR',
				'constraint'      => '1',
			],
			'nro_matricula'       => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'activo'              => [
				'type'            => 'INT',
				'constraint'      => 1,
				'unsigned'        => true,
			],
		]);
		$this->forge->addKey('id_estudiante_periodo_lectivo', true);
		$this->forge->addForeignKey('id_estudiante','sw_estudiante','id_estudiante');
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->addForeignKey('id_paralelo','sw_paralelo','id_paralelo');
		$this->forge->createTable('sw_estudiante_periodo_lectivo');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_estudiante_periodo_lectivo');
	}
}
