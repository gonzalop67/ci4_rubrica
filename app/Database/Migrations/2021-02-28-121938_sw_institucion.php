<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwInstitucion extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_institucion' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'in_nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'in_direccion' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'in_telefono' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'in_regimen' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'in_nom_rector' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'in_genero_rector' => [
				'type'       => 'VARCHAR',
				'constraint' => '1',
			],
			'in_nom_vicerrector' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'in_genero_vicerrector' => [
				'type'       => 'VARCHAR',
				'constraint' => '1',
			],
			'in_nom_secretario' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'in_genero_secretario' => [
				'type'       => 'VARCHAR',
				'constraint' => '1',
			],
			'in_url' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'in_logo' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'in_amie' => [
				'type'       => 'VARCHAR',
				'constraint' => '16',
			],
			'in_ciudad' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'in_copiar_y_pegar' => [
				'type'           => 'TINYINT',
				'constraint'     => 1,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('id_institucion', true);
		$this->forge->createTable('sw_institucion');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_institucion');
	}
}
