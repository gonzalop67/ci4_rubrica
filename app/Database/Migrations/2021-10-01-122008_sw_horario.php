<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwHorario extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_horario'         => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_asignatura'      => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_paralelo'        => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_dia_semana'      => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'id_hora_clase'      => [
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
		$this->forge->addKey('id_horario', true);
		$this->forge->addForeignKey('id_asignatura','sw_asignatura','id_asignatura');
		$this->forge->addForeignKey('id_paralelo','sw_paralelo','id_paralelo');
		$this->forge->addForeignKey('id_dia_semana','sw_dia_semana','id_dia_semana');
		$this->forge->addForeignKey('id_hora_clase','sw_hora_clase','id_hora_clase');
		$this->forge->addForeignKey('id_usuario','sw_usuario','id_usuario');
		$this->forge->createTable('sw_horario');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_horario');
	}
}
