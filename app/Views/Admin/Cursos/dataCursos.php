<?php

use App\Models\Admin\CursosModel;

$cursoModel = new CursosModel();

if ($cursos != NULL) {
    foreach ($cursos as $curso) { ?>
        <tr data-index='<?= $curso->id_curso ?>' data-orden='<?= $curso->cu_orden ?>'>
            <td><?= $curso->id_curso ?></td>
            <td>
                <?php
                echo $cursoModel->getEspecialidad($curso->id_curso);
                ?>
            </td>
            <td>
                <?php
                echo $cursoModel->getFigura($curso->id_curso);
                ?>
            </td>
            <td><?= $curso->cu_nombre ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?= base_url(route_to('cursos_edit', $curso->id_curso)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(<?= $curso->id_curso ?>)"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
    <?php }
} else {
    ?>
    <tr>
        <td colspan="5" class="text-center">No se han registrado cursos todavía...</td>
    </tr>
<?php
}
?>