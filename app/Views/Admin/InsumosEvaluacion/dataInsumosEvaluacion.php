<?php

use Hashids\Hashids;

$hash = new Hashids();

$contador = 0;
if (count($insumos_evaluacion) > 0) {
    foreach ($insumos_evaluacion as $v) {
        $contador++;
?>
        <tr>
            <td><?= $contador; ?></td>
            <td><?= $v->ru_nombre; ?></td>
            <td><?= $v->ru_abreviatura; ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?php echo base_url(route_to('insumos_evaluacion_edit', $v->id_rubrica_evaluacion)); ?>" onclick="edit(event, this, '<?= $v->id_rubrica_evaluacion ?>')" class="btn btn-warning btn-sm insumo_evaluacion_edit" title="Editar"><span class="fa fa-pencil"></span></a>
                    <a href="<?= base_url(route_to('insumos_evaluacion_delete', $hash->encode($v->id_rubrica_evaluacion))) ?>" class="btn btn-danger btn-sm insumo_evaluacion_delete" title="Eliminar"><span class="fa fa-trash"></span></a>
                </div>
            </td>
        </tr>
    <?php }
} else { ?>
    <tr>
        <td colspan="4" class="text-center">No se han ingresado Insumos de Evaluación todavía...</td>
    </tr>
<?php
}
?>

<script>
    $(".insumo_evaluacion_delete").click(function(e) {
        e.preventDefault();
        url = $(this).attr('href');
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

                            listarRubricasEvaluacion();
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