<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugPerfil extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sw_perfil', [
            'pe_slug' => [
                'type' => 'VARCHAR', // O el tipo de dato que necesites
                'constraint' => '64', // Longitud o restricciones
                // 'null' => TRUE, // Si el campo puede ser nulo
                // 'default' => '', // Valor por defecto
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sw_perfil', 'pe_slug');
    }
}
