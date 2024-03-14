<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSwQuienInsertaComp extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nombre' => [
				'type'       => 'VARCHAR',
				'constraint' => '24',
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('sw_quien_inserta_comp');
    }

    public function down()
    {
        $this->forge->dropTable('sw_quien_inserta_comp');
    }
}
