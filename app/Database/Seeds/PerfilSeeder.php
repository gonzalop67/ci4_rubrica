<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PerfilSeeder extends Seeder
{
	public function run()
	{
		$perfiles = [
            'Administrador',
            'Autoridad',
            'DECE',
            'Docente',
            'Inspector',
            'Representante',
            'Secretaría',
            'Tutor'
        ];
        foreach ($perfiles as $key) {
            $this->db->table('sw_perfil')->insert([
                'pe_nombre' => $key
            ]);
        }
	}
}
