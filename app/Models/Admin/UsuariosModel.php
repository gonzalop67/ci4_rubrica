<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UsuariosModel extends Model
{

    protected $table      = 'sw_usuario';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = [
        'us_titulo',
        'us_titulo_descripcion',
        'us_apellidos',
        'us_nombres',
        'us_shortname',
        'us_fullname',
        'us_login',
        'us_password',
        'us_foto',
        'us_genero',
        'us_activo'
    ];

    public function getRols($id_usuario)
    {
        $perfiles = $this->db->query("SELECT u.id_usuario, 
                                             p.pe_nombre 
                                        FROM sw_usuario u, 
                                             sw_perfil p, 
                                             sw_usuario_perfil up 
                                       WHERE u.id_usuario = up.id_usuario 
                                         AND p.id_perfil = up.id_perfil 
                                         AND u.id_usuario = $id_usuario 
                                       ORDER BY p.pe_nombre ASC");

        return $perfiles->getResult();
    }

}