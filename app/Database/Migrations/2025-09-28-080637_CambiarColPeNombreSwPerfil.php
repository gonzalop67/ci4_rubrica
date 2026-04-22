<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CambiarColPeNombreSwPerfil extends Migration
{
    public function up()
    {
        $fields = [
            'pe_nombre' => [
                'name' => 'pe_nombre',
                'type' => 'VARCHAR', // Nuevo tipo de dato
                'constraint' => 64, // Nueva longitud, por ejemplo
                // Otras opciones de campo si son necesarias
            ],
        ];
        $this->forge->modifyColumn('sw_perfil', $fields);
    }

    public function down()
    {
        $fields = [
            'pe_nombre' => [
                'name' => 'pe_nombre',
                'type' => 'VARCHAR', // Nuevo tipo de dato
                'constraint' => 16, // Nueva longitud, por ejemplo
                // Otras opciones de campo si son necesarias
            ],
        ];
        $this->forge->modifyColumn('sw_perfil', $fields);
    }
}
