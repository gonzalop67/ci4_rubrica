<table id="tbl_asignaturas" class="table table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>Area</th>
            <th>Nombre</th>
            <th>Abreviatura</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php

        use Hashids\Hashids;

        $hash = new Hashids();
        $contador = 0;
        foreach ($asignaturas as $v) {
            $contador++;
        ?>
            <tr>
                <td><?= $contador; ?></td>
                <td><?= $v->id_asignatura; ?></td>
                <td><?= $v->ar_nombre; ?></td>
                <td><?= $v->as_nombre; ?></td>
                <td><?= $v->as_abreviatura; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="<?= base_url(route_to('asignaturas_edit', $v->id_asignatura)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                        <a href="<?= base_url(route_to('asignaturas_delete', $hash->encode($v->id_asignatura))) ?>" class="btn btn-danger btn-sm areas_delete" title="Eliminar"><span class="fa fa-trash"></span></a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(".areas_delete").click(function(e) {
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

                            dataAsignaturas();
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