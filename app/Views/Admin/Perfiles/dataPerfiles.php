<table id="tbl_perfiles" class="table table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody class="viewdata">
        <?php
        $contador = 0;
        foreach ($perfiles as $v) {
            $contador++;
        ?>
            <tr>
                <td><?= $contador; ?></td>
                <td><?= $v->id_perfil; ?></td>
                <td><?= $v->pe_nombre; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="<?= base_url(route_to('perfiles_edit', $v->id_perfil)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(<?= $v->id_perfil ?>)"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function eliminar(id) {
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
                    url: "<?= base_url(route_to('perfiles_delete')) ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.icon === "success") {
                            Swal.fire({
                                icon: response.icon,
                                title: "Eliminar",
                                text: response.message,
                            });

                            dataPerfiles();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>