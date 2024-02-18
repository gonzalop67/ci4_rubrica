<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Modalidades
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <!-- <h2 class="mt-4">Modalidades</h2> -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Administración de Modalidades</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listado
        </div>
        <div class="card-body">
            <?php if (session('msg')) : ?>
                <div class="alert alert-<?= session('msg.type') ?> alert-dismissible fade show" role="alert">
                    <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <a href="<?= base_url(route_to('modalidades_create')) ?>" class="btn btn-block btn-success btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Nuevo registro
            </a>
            <table id="tbl_modalidad" class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php foreach ($modalidades as $modalidad) { ?>
                        <tr>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
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
                    url: "<?= base_url(route_to('modalidades_delete')) ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: response.sukses,
                            });
                            datamahasiswa();
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
<?= $this->endsection('scripts') ?>