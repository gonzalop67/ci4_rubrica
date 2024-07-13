<?php

use Hashids\Hashids;

$hash = new Hashids();

$contador = 0;
if (count($aportes_evaluacion) > 0) {
    foreach ($aportes_evaluacion as $v) {
        $contador++;
?>
        <tr data-index='<?= $v->id_aporte_evaluacion ?>' data-orden='<?= $v->ap_orden ?>'>
            <td><?= $contador; ?></td>
            <td><?= $v->ap_nombre; ?></td>
            <td><?= $v->ta_descripcion; ?></td>
            <td><?= ($v->ap_ponderacion * 100) . '%'; ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?= base_url(route_to('aportes_evaluacion_edit', $v->id_aporte_evaluacion)); ?>" onclick="edit(event, this, '<?= $v->id_aporte_evaluacion ?>')" class="btn btn-warning btn-sm aporte_evaluacion_edit" title="Editar"><span class="fa fa-pencil"></span></a>
                    <a href="<?= base_url(route_to('aportes_evaluacion_delete', $hash->encode($v->id_aporte_evaluacion))) ?>" class="btn btn-danger btn-sm aporte_evaluacion_delete" title="Eliminar"><span class="fa fa-trash"></span></a>
                </div>
            </td>
        </tr>
    <?php }
} else { ?>
    <tr>
        <td colspan="5" class="text-center">No se han ingresado Aportes de Evaluación todavía...</td>
    </tr>
<?php
}
?>

<script>
    $(".aporte_evaluacion_delete").click(function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        const id_periodo_evaluacion = $("#id_periodo_evaluacion").val();
        Swal.fire({
            title: "Eliminar",
            text: "¿Está seguro de eliminar este registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, elimínelo!",
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        if (response.icon === "success") {
                            Swal.fire({
                                icon: response.icon,
                                title: "Eliminar",
                                text: response.message,
                            });

                            listarAportes(id_periodo_evaluacion);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    });
</script>