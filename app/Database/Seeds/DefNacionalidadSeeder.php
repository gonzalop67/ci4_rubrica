<?php 
namespace App\Database\Seeds;

class DefNacionalidadSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $nacionalidades = [
            'Ecuatoriana',
            'Colombiana',
            'Venezolana',
            'Haitiana'
        ];
        foreach ($nacionalidades as $key) {
            $this->db->table('sw_def_nacionalidad')->insert([
                'dn_nombre' => $key
            ]);
        }
    }
}