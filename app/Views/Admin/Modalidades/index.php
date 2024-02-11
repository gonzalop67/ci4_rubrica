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
            <a href="#!" class="btn btn-block btn-success btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Nuevo registro
            </a>
            <table id="tbl_modalidad" class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Activo</th>
                    <th colspan="2">Acciones</th>
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
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>