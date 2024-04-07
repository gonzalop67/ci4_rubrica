<?php
if ($nivelesEducacion != NULL) {
    foreach ($nivelesEducacion as $nivelEducacion) { ?>
        <tr data-index='<?= $nivelEducacion->id_nivel_educacion ?>' data-orden='<?= $nivelEducacion->orden ?>'>
            <td><?= $nivelEducacion->id_nivel_educacion ?></td>
            <td><?= $nivelEducacion->nombre ?></td>
            <td><?= $nivelEducacion->es_bachillerato == 1 ? 'Sí' : 'No' ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?= base_url(route_to('niveles_educacion_edit', $nivelEducacion->id_nivel_educacion)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(<?= $nivelEducacion->id_nivel_educacion ?>)"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="4" class="text-center">No se han registrado Niveles de Educación todavía...</td>
    </tr>
<?php } ?>