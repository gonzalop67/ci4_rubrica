<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Periodos de Evaluacion
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <!-- <h2 class="mt-4">Modalidades</h2> -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Administración de Periodos de Evaluación</li>
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
            <a href="<?= base_url(route_to('periodos_evaluacion_create')) ?>" class="btn btn-block btn-primary btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Crear Periodo de Evaluación
            </a>
            <hr>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table id="tbl_periodo_evaluacion" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Ponderación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_periodos_evaluacion">
                            <?php

                            use Hashids\Hashids;

                            $hash = new Hashids();

                            $contador = 0;
                            foreach ($periodos_evaluacion as $v) {
                                $contador++;
                            ?>
                                <tr>
                                    <td><?= $contador; ?></td>
                                    <td><?= $v->pe_nombre; ?></td>
                                    <td><?= ($v->pe_ponderacion * 100) . '%'; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url(route_to('periodos_evaluacion_edit', $hash->encode($v->id_periodo_evaluacion))) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                                            <a href="<?= base_url(route_to('periodos_evaluacion_delete', $hash->encode($v->id_periodo_evaluacion))) ?>" class="btn btn-danger btn-sm perfiles_delete" title="Eliminar"><span class="fa fa-trash"></span></a>
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
<script>
    $(document).ready(function() {
        // dataAsignaturas();

        //Autoclose
        window.setTimeout(function() {
            $(".alert").fadeOut(1500, 0);
        }, 3000); //3 segundos y desaparece
    });
</script>
<?= $this->endsection('scripts') ?>