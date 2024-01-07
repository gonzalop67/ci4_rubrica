<?php 
namespace App\Database\Seeds;

class TipoDocumentoSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $tipos_documento = [
            'Cédula de Identidad',
            'Pasaporte',
            'Carnet de refugiado'
        ];
        foreach ($tipos_documento as $key) {
            $this->db->table('sw_tipo_documento')->insert([
                'td_nombre' => $key
            ]);
        }
    }
}