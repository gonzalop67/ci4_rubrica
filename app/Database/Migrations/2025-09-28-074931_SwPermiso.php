<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SwPermiso extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_permiso' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '32',
			],
		]);
		$this->forge->addKey('id_permiso', true);
		$this->forge->createTable('sw_permiso');
    }

    public function down()
    {
        $this->forge->dropTable('sw_permiso');
    }
}
