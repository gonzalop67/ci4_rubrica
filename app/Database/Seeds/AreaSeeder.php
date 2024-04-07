<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AreaSeeder extends Seeder
{
	public function run()
	{
		$areas = [
            'CIENCIAS NATURALES',  // id_area = 1
            'CIENCIAS SOCIALES', // id_area = 2
            'EDUCACION CULTURAL Y ARTISTICA', // id_area = 3
            'EDUCACION FISICA', // id_area = 4
            'LENGUA EXTRANJERA', // id_area = 5
            'LENGUA Y LITERATURA', // id_area = 6
            'MATEMATICA', // id_area = 7
            'MODULO INTER-ÁREAS', // id_area = 8
            'PROYECTOS ESCOLARES', // id_area = 9
            'CONTABILIDAD', // id_area = 10
            'INFORMATICA' // id_area = 11
        ];
        foreach ($areas as $key) {
            $this->db->table('sw_area')->insert([
                'ar_nombre' => $key
            ]);
        }
	}
}
