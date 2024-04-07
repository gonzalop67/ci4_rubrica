<?php

use App\Models\Admin\EspecialidadesModel;

$especialidadModel = new EspecialidadesModel();

if ($especialidades != NULL) {
    foreach ($especialidades as $especialidad) { ?>
        <tr data-index='<?= $especialidad->id_especialidad ?>' data-orden='<?= $especialidad->es_orden ?>'>
            <td><?= $especialidad->id_especialidad ?></td>
            <td>
                <?php
                echo $especialidadModel->getNivelEducacion($especialidad->id_especialidad);
                ?>
            </td>
            <td><?= $especialidad->es_nombre ?></td>
            <td><?= $especialidad->es_figura ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?= base_url(route_to('especialidades_edit', $especialidad->id_especialidad)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(<?= $especialidad->id_especialidad ?>)"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
    <?php }
} else {
    ?>
    <tr>
        <td colspan="5" class="text-center">No se han registrado Especialidades todavía...</td>
    </tr>
<?php
}
?>