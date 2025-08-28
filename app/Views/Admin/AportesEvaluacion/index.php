<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Aportes de Evaluacion
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<style>
    #nombre, #abreviatura, #descripcion {
        text-transform: uppercase;
    }
</style>
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
            <button id="btn_nuevo_aporte" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nuevoAporteModal"><i class="fa fa-plus-circle"></i> Nuevo Registro</button>
            <hr>
            <div class="mb-3">
                <label for="id_periodo_evaluacion" class="form-label">Elegir Periodo de Evaluación:</label>
                <select class="form-select" id="id_periodo_evaluacion" name="id_periodo_evaluacion">
                    <option value="">Seleccionar...</option>
                    <?php
                    foreach ($periodos_evaluacion as $v) {
                    ?>
                        <option value="<?php echo $v->id_sub_periodo_evaluacion; ?>"><?php echo $v->pe_nombre; ?></option>
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
                                <th>Tipo</th>
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
        $('#btn_nuevo_aporte').attr('disabled', true);

        $("#id_periodo_evaluacion").change(function(e) {
            const id_periodo_evaluacion = $(this).val();
            if (id_periodo_evaluacion !== "") {
                $('#btn_nuevo_aporte').attr('disabled', false);
                listarAportes(id_periodo_evaluacion);
            } else {
                $('#btn_nuevo_aporte').attr('disabled', true);
                Swal.fire({
                    title: "Aportes de Evaluación",
                    text: "Tiene que elegir un periodo de evaluación...",
                    icon: "info"
                });
            }
        });

        $('#btn_nuevo_aporte').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url(route_to('aportes_evaluacion_form_crear')) ?>",
                dataType: "json",
                success: function(response) {
                    // alert(response.data);
                    $('.viewmodal').html(response.data).show();
                    $('#nuevoAporteModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

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

    function edit(e, obj, id_aporte_evaluacion) {
        e.preventDefault();

        const url = $(obj).attr("href");

        $.ajax({
            type: "post",
            url: url,
            data: {
                id_aporte_evaluacion: id_aporte_evaluacion
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewmodal').html(response.success).show();
                    $('#editarAporteModal').modal('show');
                }
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

        id_periodo_evaluacion = $("#id_periodo_evaluacion").val();
        $.ajax({
            url: "<?= base_url(route_to('aportes_evaluacion_saveNewPositions')); ?>",
            method: 'POST',
            dataType: 'text',
            data: {
                positions: positions
            },
            success: function(response) {
                listarAportes(id_periodo_evaluacion);
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>