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
        $menus = $this->db->query("SELECT m.*, pe_nombre
                                     FROM sw_menu m,
                                          sw_menu_perfil mp,
                                          sw_perfil p 
                                    WHERE m.id_menu = mp.id_menu 
                                      AND p.id_perfil = mp.id_perfil 
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

    public function guardarOrden($menu)
    {
        $menus = json_decode($menu);
        foreach ($menus as $var => $menu) {
            $this->update($menu->id, [
                'mnu_padre' => 0,
                'mnu_orden' => $var + 1
            ]);
            // self::where('id', $menu->id)->update(['menu_id' => null, 'orden' => $var + 1]);
            if (!empty($menu->children)) {
                $this->guardarOrdenHijos($menu->children, $menu);
            }
        }
    }

    public function guardarOrdenHijos($hijos, $padre)
    {
        foreach ($hijos as $key => $hijo) {
            $this->update($hijo->id, [
                'mnu_padre' => $padre->id,
                'mnu_orden' => $key + 1
            ]);
            // self::where('id_menu', $hijo['id'])->update(['mnu_padre' => $padre['id'], ',mnu_orden' => $key + 1]);
            if (!empty($hijo->children)) {
                $this->guardarOrdenHijos($hijo->children, $hijo);
            }
        }
    }
}
