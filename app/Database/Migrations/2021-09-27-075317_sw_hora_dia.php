<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwHoraDia extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_hora_dia'        => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
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
		]);
		$this->forge->addKey('id_hora_dia', true);
		$this->forge->addForeignKey('id_dia_semana','sw_dia_semana','id_dia_semana');
		$this->forge->addForeignKey('id_hora_clase','sw_hora_clase','id_hora_clase');
		$this->forge->createTable('sw_hora_dia');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_hora_dia');
	}
}
