<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InstitucionSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'in_nombre' => 'UNIDAD EDUCATIVA PCEI FISCAL SALAMANCA',
            'in_direccion' => 'Calle el Tiempo y Pasaje Mónaco',
            'in_telefono' => '2256311/2254818',
            'in_nom_rector' => 'DR. RAMIRO CASTILLO',
            'in_nom_vicerrector' => 'Lic. Rómulo Mejía',
            'in_nom_secretario' => 'Lic. Alicia Salazar O.',
            'in_url' => 'http://colegionocturnosalamanca.com',
            'in_logo' => 'logo_salamanca.gif',
            'in_amie' => '17H00215',
            'in_ciudad' => 'Quito D.M.'
		];
	
		// Using Query Builder
		$this->db->table('sw_institucion')->insert($data);
	}
}
