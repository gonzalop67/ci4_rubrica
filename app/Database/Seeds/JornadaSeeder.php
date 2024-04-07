<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JornadaSeeder extends Seeder
{
	public function run()
	{
		$jornadas = [
            'MATUTINA',
            'VESPERTINA',
            'NOCTURNA'
        ];
        foreach ($jornadas as $key) {
            $this->db->table('sw_jornada')->insert([
                'jo_nombre' => $key
            ]);
        }
	}
}
