<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Periodos Lectivos
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <!-- <h2 class="mt-4">Modalidades</h2> -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Administración de Periodos Lectivos</li>
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
            <a href="<?= base_url(route_to('periodos_lectivos_create')) ?>" class="btn btn-block btn-danger btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Crear Periodo Lectivo
            </a>
            <hr>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table id="tbl_periodo_lectivo" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Modalidad</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_periodos_lectivos">
                            <?php
                            $contador = 0;
                            foreach ($periodos_lectivos as $v) {
                                $contador++;
                            ?>
                                <tr>
                                    <td><?= $contador; ?></td>
                                    <td><?= $v->id_periodo_lectivo; ?></td>
                                    <td><?= $v->mo_nombre; ?></td>
                                    <td><?php $fecha = date_create($v->pe_fecha_inicio);
                                        echo date_format($fecha, "d/M/Y") ?></td>
                                    <td><?php $fecha = date_create($v->pe_fecha_fin);
                                        echo date_format($fecha, "d/M/Y"); ?></td>
                                    <td><?= $v->pe_descripcion; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url(route_to('periodos_lectivos_edit', $v->id_periodo_lectivo)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // jQuery listo para usar
        const datatablesSimple = document.getElementById('tbl_periodo_lectivo');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>
<?= $this->endsection('scripts') ?>