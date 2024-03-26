<?php

use Hashids\Hashids;

$hash = new Hashids();

$contador = 0;
foreach ($periodos_evaluacion as $v) {
    $contador++;
?>
    <tr data-index='<?= $v->id_periodo_evaluacion ?>' data-orden='<?= $v->pe_orden ?>'>
        <td><?= $contador; ?></td>
        <td><?= $v->pe_nombre; ?></td>
        <td><?= ($v->pe_ponderacion * 100) . '%'; ?></td>
        <td>
            <div class="btn-group">
                <a href="<?= base_url(route_to('periodos_evaluacion_edit', $v->id_periodo_evaluacion)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                <a href="<?= base_url(route_to('periodos_evaluacion_delete', $hash->encode($v->id_periodo_evaluacion))) ?>" class="btn btn-danger btn-sm periodos_evaluacion_delete" title="Eliminar"><span class="fa fa-trash"></span></a>
            </div>
        </td>
    </tr>
<?php } ?>

<script>
    $(".periodos_evaluacion_delete").click(function(e) {
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

                            dataPeriodosEvaluacion();
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