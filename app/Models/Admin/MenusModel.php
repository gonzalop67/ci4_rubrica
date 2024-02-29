<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MenusModel extends Model
{

    protected $table      = 'sw_menu';
    protected $primaryKey = 'id_menu';

    protected $useAutoIncrement = true;
    protected $returnType     = 'object';

    protected $allowedFields = [
        'mnu_texto',
        'mnu_link',
        'mnu_nivel',
        'mnu_orden',
        'mnu_padre',
        'mnu_publicado',
        'mnu_icono'
    ];

    public function listarMenusNivel1($id_perfil)
    {
        $menus = $this->db->query("SELECT m.*
                                     FROM sw_menu m,
                                          sw_menu_perfil mp 
                                    WHERE m.id_menu = mp.id_menu
                                      AND mp.id_perfil = $id_perfil 
                                      AND mnu_padre = 0
                                    ORDER BY mnu_orden");

        return $menus->getResultObject();
    }

    public function listarMenusHijos($mnu_padre)
    {
        $menus = $this->db->query("SELECT *
                                     FROM sw_menu
                                    WHERE mnu_padre = $mnu_padre
                                    ORDER BY mnu_orden");

        return $menus->getResult();
    }
}
