<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Paralelos
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Administración de Paralelos</li>
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
            <a href="<?= base_url(route_to('paralelos_create')) ?>" class="btn btn-block btn-success btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Nuevo Paralelo
            </a>
            <hr>
            <table id="tbl_paralelos" class="table table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>ID</th>
                    <th>Especialidad</th>
                    <th>Curso</th>
                    <th>Nombre</th>
                    <th>Jornada</th>
                    <th>Acciones</th>
                </thead>
                <tbody class="viewdata">

                </tbody>
            </table>
        </div>

    </div>
</div>
<?= $this->endsection('content') ?>