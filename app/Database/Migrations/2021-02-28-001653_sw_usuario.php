<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwUsuario extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_usuario' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'us_titulo' => [
				'type'       => 'VARCHAR',
				'constraint' => '8',
			],
			'us_titulo_descripcion' => [
				'type'       => 'VARCHAR',
				'constraint' => '96',
			],
			'us_apellidos' => [
				'type'       => 'VARCHAR',
				'constraint' => '32',
			],
			'us_nombres' => [
				'type'       => 'VARCHAR',
				'constraint' => '32',
			],
			'us_shortname' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'us_fullname' => [
				'type'       => 'VARCHAR',
				'constraint' => '64',
			],
			'us_login' => [
				'type'       => 'VARCHAR',
				'constraint' => '24',
			],
			'us_password' => [
				'type'       => 'VARCHAR',
				'constraint' => '535',
			],
			'us_foto' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'us_genero' => [
				'type'       => 'VARCHAR',
				'constraint' => '1',
			],
			'us_activo' => [
				'type'       => 'INT',
				'constraint' => 1,
				'unsigned'   => true,
			],
		]);
		$this->forge->addKey('id_usuario', true);
		$this->forge->createTable('sw_usuario');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_usuario');
	}
}
