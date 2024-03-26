<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Ponderación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php

        use Hashids\Hashids;

        $hash = new Hashids();

        $contador = 0;
        foreach ($periodos_evaluacion as $v) {
            $contador++;
        ?>
            <tr>
                <td><?= $contador; ?></td>
                <td><?= $v->pe_nombre; ?></td>
                <td><?= ($v->pe_ponderacion * 100) . '%'; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="<?= base_url(route_to('periodos_evaluacion_edit', $v->id_periodo_evaluacion)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                        <a href="<?= base_url(route_to('periodos_evaluacion_delete', $hash->encode($v->id_periodo_evaluacion))) ?>" class="btn btn-danger btn-sm perfiles_delete" title="Eliminar"><span class="fa fa-trash"></span></a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>