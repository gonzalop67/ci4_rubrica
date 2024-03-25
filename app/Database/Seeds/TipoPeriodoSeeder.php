<?php 
namespace App\Database\Seeds;

class TipoPeriodoSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $tipos_periodo = [
            'QUIMESTRE',
            'SUPLETORIO',
            'REMEDIAL',
            'DE GRACIA',
            'REFUERZO',
            'PROYECTO FINAL'
        ];
        foreach ($tipos_periodo as $key) {
            $this->db->table('sw_tipo_periodo')->insert([
                'tp_descripcion' => $key
            ]);
        }
    }
}