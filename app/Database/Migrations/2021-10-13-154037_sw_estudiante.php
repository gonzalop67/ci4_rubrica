<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwEstudiante extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_estudiante'       => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
				'auto_increment'  => true,
			],
			'id_tipo_documento'   => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'id_def_genero'       => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'id_def_nacionalidad' => [
				'type'            => 'INT',
				'constraint'      => 11,
				'unsigned'        => true,
			],
			'es_apellidos'        => [
				'type'            => 'VARCHAR',
				'constraint'      => '32',
			],
			'es_nombres'          => [
				'type'            => 'VARCHAR',
				'constraint'      => '32',
			],
			'es_nombre_completo'  => [
				'type'            => 'VARCHAR',
				'constraint'      => '64',
			],
			'es_cedula'           => [
				'type'            => 'VARCHAR',
				'constraint'      => '10',
			],
			'es_email'            => [
				'type'            => 'VARCHAR',
				'constraint'      => '64',
			],
			'es_sector'           => [
				'type'            => 'VARCHAR',
				'constraint'      => '36',
			],
			'es_direccion'        => [
				'type'            => 'VARCHAR',
				'constraint'      => '64',
			],
			'es_telefono'         => [
				'type'            => 'VARCHAR',
				'constraint'      => '32',
			],
			'es_fec_nacim'        => [
				'type'            => 'DATE'
			],
		]);
		$this->forge->addKey('id_estudiante', true);
		$this->forge->addForeignKey('id_tipo_documento','sw_tipo_documento','id_tipo_documento');
		$this->forge->addForeignKey('id_def_genero','sw_def_genero','id_def_genero');
		$this->forge->addForeignKey('id_def_nacionalidad','sw_def_nacionalidad','id_def_nacionalidad');
		$this->forge->createTable('sw_estudiante');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sw_estudiante');
	}
}
