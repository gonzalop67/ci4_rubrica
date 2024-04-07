<?php

use Hashids\Hashids;

$hash = new Hashids();

$contador = 0;
if (count($escalas_calificaciones) > 0) {
    foreach ($escalas_calificaciones as $v) {
        $contador++;
?>
        <tr data-index='<?= $v->id_escala_calificaciones ?>' data-orden='<?= $v->ec_orden ?>'>
            <td><?= $contador; ?></td>
            <td><?= $v->ec_cualitativa; ?></td>
            <td><?= $v->ec_cuantitativa; ?></td>
            <td><?= $v->ec_nota_minima; ?></td>
            <td><?= $v->ec_nota_maxima; ?></td>
            <td><?= $v->ec_equivalencia; ?></td>
            <td>
                <div class="btn-group">
                    <a href="<?php echo base_url(route_to('escalas_calificaciones_edit', $v->id_escala_calificaciones)); ?>" onclick="edit(event, this, '<?= $v->id_escala_calificaciones ?>')" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                    <a href="<?= base_url(route_to('escalas_calificaciones_delete', $hash->encode($v->id_escala_calificaciones))) ?>" class="btn btn-danger btn-sm escala_calificacion_delete" title="Eliminar"><span class="fa fa-trash"></span></a>
                </div>
            </td>
        </tr>
    <?php }
} else { ?>
    <tr>
        <td colspan="7" class="text-center">No se han ingresado Escalas de Calificación todavía...</td>
    </tr>
<?php
}
?>

<script>
    $(".escala_calificacion_delete").click(function(e) {
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

                            listarEscalasCalificaciones();
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