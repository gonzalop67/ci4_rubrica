<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioAdministradorSeeder extends Seeder
{
	public function run()
	{

		$data = [
			'us_titulo'    => 'Ing.',
			'us_titulo_descripcion' => 'Ingeniero en Sistemas Informáticos y de Computación',
			'us_login'     => 'Administrador',
            'us_password'  => password_hash('gP67M24e$', PASSWORD_DEFAULT),
			'us_apellidos' => 'Peñaherrera Escobar',
			'us_nombres'   => 'Gonzalo Nicolás',
			'us_shortname' => 'Ing. Gonzalo Peñaherrera',
			'us_fullname'  => 'Peñaherrera Escobar Gonzalo Nicolás',
			'us_foto'      => 'gonzalo-foto-3.png',
            'us_genero'    => 'M',
            'us_activo'    => 1
		];
	
		// Using Query Builder
		$this->db->table('sw_usuario')->insert($data);
		$this->db->table('sw_usuario_perfil')->insert([
            'id_usuario' => 1,
            'id_perfil' => 1
        ]);
	}
}
