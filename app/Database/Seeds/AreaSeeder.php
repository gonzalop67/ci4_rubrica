<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AreaSeeder extends Seeder
{
	public function run()
	{
		$areas = [
            'CIENCIAS NATURALES',
            'CIENCIAS SOCIALES',
            'EDUCACION CULTURAL Y ARTISTICA',
            'EDUCACION FISICA',
            'LENGUA EXTRANJERA',
            'LENGUA Y LITERATURA',
            'MATEMATICA',
            'MODULO INTER-ÁREAS',
            'PROYECTOS ESCOLARES'
        ];
        foreach ($areas as $key) {
            $this->db->table('sw_area')->insert([
                'ar_nombre' => $key
            ]);
        }
	}
}
