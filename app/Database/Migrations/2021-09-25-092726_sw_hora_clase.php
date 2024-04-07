<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwHoraClase extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_hora_clase'      => [
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
			'hc_nombre'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '12',
			],
			'hc_hora_inicio'     => [
				'type'           => 'TIME'
			],
			'hc_hora_fin'     => [
				'type'           => 'TIME'
			],
			'hc_ordinal'         => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'hc_tipo'            => [
				'type'           => 'CHAR',
				'constraint'     => 1,
				'default'        => 'C'
			]
		]);
		$this->forge->addKey('id_hora_clase', true);
		$this->forge->addForeignKey('id_periodo_lectivo','sw_periodo_lectivo','id_periodo_lectivo');
		$this->forge->createTable('sw_hora_clase');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_hora_clase');
	}
}
