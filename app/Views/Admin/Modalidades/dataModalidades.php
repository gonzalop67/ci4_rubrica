<?php foreach ($modalidades as $modalidad) { ?>
    <tr data-index='<?= $modalidad->id_modalidad ?>' data-orden='<?= $modalidad->mo_orden ?>'>
        <td><?= $modalidad->id_modalidad ?></td>
        <td><?= $modalidad->mo_nombre ?></td>
        <td>
            <?php if ($modalidad->mo_activo == 1) : ?>
                <span class="badge bg-success">Activo</span>
            <?php else : ?>
                <span class="badge bg-danger">Inactivo</span>
            <?php endif ?>
        </td>
        <td>
            <div class="btn-group">
                <a href="<?= base_url(route_to('modalidades_edit', $modalidad->id_modalidad)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(<?= $modalidad->id_modalidad ?>)"><i class="fa fa-trash"></i></button>
            </div>
        </td>
    </tr>
<?php } ?>