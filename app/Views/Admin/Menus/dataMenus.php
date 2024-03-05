<?php
use App\Models\Admin\MenusModel;

$model = new MenusModel();

// $menusNivel1 = $model->listarMenusNivel1(session("id_perfil"));
foreach ($menus as $menu) {
?>
    <li class="dd-item dd3-item" data-id="<?php echo $menu->id_menu; ?>">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content menu_link">
            <a href="<?php echo base_url(route_to('menus_edit', $menu->id_menu)); ?>" onclick="edit(event, this, '<?= $menu->id_menu ?>')"><?php echo "(" . $menu->pe_nombre . ") " . $menu->mnu_texto; ?></a>
            <div class="float-end">
                <a href="<?php echo base_url(route_to('menus_delete', $menu->id_menu)); ?>" class="eliminar-menu" title="Eliminar este menú" onclick="eliminar(event, this, <?= $menu->id_menu ?>)"><i class="text-danger fa-solid fa-trash-can"></i></a>
            </div>
        </div>
        <?php
        $menusNivel2 = $model->listarMenusHijos($menu->id_menu);
        if (count($menusNivel2) > 0) {
        ?>
            <ol class="dd-list">
                <?php
                foreach ($menusNivel2 as $menu2) {
                ?>
                    <li class="dd-item dd3-item" data-id="<?php echo $menu2->id_menu; ?>">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content menu_link">
                            <a href="<?php echo base_url(route_to('menus_edit', $menu2->id_menu)); ?>" onclick="edit(event, this, '<?= $menu2->id_menu ?>')"><?php echo $menu2->mnu_texto; ?></a>
                            <div class="float-end">
                                <a href="<?php echo base_url(route_to('menus_delete', $menu2->id_menu)); ?>" class="eliminar-menu" title="Eliminar este menú" onclick="eliminar(event, this, <?= $menu2->id_menu ?>)"><i class="text-danger fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ol>
        <?php } ?>
    </li>
<?php } ?>