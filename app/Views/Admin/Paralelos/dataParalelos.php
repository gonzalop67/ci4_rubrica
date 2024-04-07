<?php

use App\Models\Admin\ParalelosModel;

$paraleloModel = new ParalelosModel();

if ($paralelos != NULL) {
    $contador = 0;
    foreach ($paralelos as $paralelo) {
        $contador++;
?>
        <tr data-index='<?= $paralelo->id_paralelo ?>' data-orden='<?= $paralelo->pa_orden ?>'>
            <td><?= $contador ?></td>
            <td><?= $paralelo->id_paralelo ?></td>
            <td><?= $paralelo->es_figura ?></td>
            <td><?= $paralelo->cu_nombre ?></td>
            <td><?= $paralelo->pa_nombre ?></td>
            <td><?= $paralelo->jo_nombre ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?= base_url(route_to('paralelos_edit', $paralelo->id_paralelo)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(<?= $paralelo->id_paralelo ?>)"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <td colspan="7" class="text-center">No se han registrado Paralelos todavía...</td>
    </tr>
<?php } ?>