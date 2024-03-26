<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Aportes de Evaluacion
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <!-- <h2 class="mt-4">Modalidades</h2> -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Administración de Aportes de Evaluación</li>
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
            <button id="btn_nuevo_periodo" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nuevoPeriodoModal"><i class="fa fa-plus-circle"></i> Nuevo Registro</button>
            <hr>
            <div class="mb-3">
                <label for="id_periodo_evaluacion" class="form-label">Elegir Periodo de Evaluación:</label>
                <select class="form-select" id="id_periodo_evaluacion" name="id_periodo_evaluacion">
                    <option value="">Seleccionar...</option>
                    <?php
                    foreach ($periodos_evaluacion as $v) {
                    ?>
                        <option value="<?php echo $v->id_periodo_evaluacion; ?>"><?php echo $v->pe_nombre; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Ponderación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="viewdata">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display: none;"></div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // dataAportesEvaluacion();

        $("#id_periodo_evaluacion").change(function(e) {
            const id_periodo_evaluacion = $(this).val();
            if (id_periodo_evaluacion !== "") {
                listarAportes(id_periodo_evaluacion);
            } else {
                Swal.fire({
                    title: "Aportes de Evaluación",
                    text: "Tiene que elegir un periodo de evaluación...",
                    icon: "info"
                });

            }
        });

        //Autoclose
        window.setTimeout(function() {
            $(".alert").fadeOut(1500, 0);
        }, 3000); //3 segundos y desaparece

        $('table tbody').sortable({
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-orden') != (index + 1)) {
                        $(this).attr('data-orden', (index + 1)).addClass('updated');
                    }
                });

                saveNewPositions();
            }
        });
    });

    function dataAportesEvaluacion() {
        $.ajax({
            url: "<?= base_url(route_to('aportes_evaluacion_data')) ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function listarAportes(id_periodo_evaluacion) {
        $.ajax({
            type: "post",
            url: "<?= base_url(route_to('aportes_evaluacion_data')) ?>",
            data: {
                id_periodo_evaluacion: id_periodo_evaluacion
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function saveNewPositions() {
        var positions = [];
        $('.updated').each(function() {
            positions.push([$(this).attr('data-index'), $(this).attr('data-orden')]);
            $(this).removeClass('updated');
        });

        $.ajax({
            url: "<?= base_url(route_to('periodos_evaluacion_saveNewPositions')); ?>",
            method: 'POST',
            dataType: 'text',
            data: {
                positions: positions
            },
            success: function(response) {
                dataPeriodosEvaluacion();
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>