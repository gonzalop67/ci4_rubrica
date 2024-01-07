<?php 
namespace App\Database\Seeds;

class TipoAsignaturaSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $data = [
            'ta_descripcion' => 'CUANTITATIVA',
        ];

        $this->db->table('sw_tipo_asignatura')->insert($data);

        $data = [
            'ta_descripcion' => 'CUALITATIVA',
        ];

        $this->db->table('sw_tipo_asignatura')->insert($data);
    }
}