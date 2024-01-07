<?php 
namespace App\Database\Seeds;

class TipoAporteSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $tipos_aporte = [
            'PARCIAL',
            'EXAMEN QUIMESTRAL',
            'SUPLETORIO'
        ];
        foreach ($tipos_aporte as $key) {
            $this->db->table('sw_tipo_aporte')->insert([
                'ta_descripcion' => $key
            ]);
        }
    }
}