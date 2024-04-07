<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Administrar Insumos de Evaluación
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Administración de Insumos de Evaluación
        </div>

        <div class="card-body">
            <button id="btn_nuevo_insumo" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nuevoInsumoModal"><i class="fa fa-plus-circle"></i> Nuevo Registro</button>
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
            <div class="mb-3">
                <label for="id_aporte_evaluacion" class="form-label">Elegir Aporte de Evaluación:</label>
                <select class="form-select" id="id_aporte_evaluacion" name="id_aporte_evaluacion">
                    <option value="">Seleccionar...</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_tipo_asignatura" class="form-label">Elegir Tipo de Asignatura:</label>
                <select class="form-select" id="id_tipo_asignatura" name="id_tipo_asignatura">
                    <?php
                    foreach ($tipos_asignatura as $v) {
                    ?>
                        <option value="<?php echo $v->id_tipo_asignatura; ?>"><?php echo $v->ta_descripcion; ?></option>
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
                                <th>Abreviatura</th>
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
        // JQuery Listo para utilizar
        $("#btn_nuevo_insumo").attr("disabled", true);
        $("#id_aporte_evaluacion").attr("disabled", true);
        $("#id_tipo_asignatura").attr("disabled", true);

        $(".viewdata").html("<tr><td colspan='4' align='center'>Debes seleccionar un periodo de evaluación...</td></tr>");

        $("#id_periodo_evaluacion").change(function(e) {
            // Código para recuperar los aportes de evaluación asociados al período de evaluación seleccionado
            if ($(this).val() == "") {
                $("#btn_nuevo_insumo").attr("disabled", true);
                $("#id_aporte_evaluacion").attr("disabled", true);
                $("#id_tipo_asignatura").attr("disabled", true);
                document.getElementById("id_aporte_evaluacion").length = 0;
                $('#id_aporte_evaluacion').append('<option value="">Seleccione...</option>');
                $(".viewdata").html("<tr><td colspan='4' align='center'>Debes seleccionar un periodo de evaluación...</td></tr>");
            } else {
                $("#btn_nuevo_insumo").attr("disabled", false);
                $("#id_aporte_evaluacion").attr("disabled", false);
                $("#id_tipo_asignatura").attr("disabled", false);
                $(".viewdata").html("<tr><td colspan='4' align='center'>Debes seleccionar un aporte de evaluación...</td></tr>");
                cargarAportesEvaluacion();
            }
        });

        $("#id_aporte_evaluacion").change(function() {
            if ($(this).val() != "") {
                $("#btn_nuevo_insumo").attr("disabled", false);
                $("#id_tipo_asignatura").attr("disabled", false);
                listarRubricasEvaluacion();
            } else {
                $("#btn_nuevo_insumo").attr("disabled", true);
                $("#id_tipo_asignatura").attr("disabled", true);
                $(".viewdata").html("<tr><td colspan='4' align='center'>Debes seleccionar un aporte de evaluación...</td></tr>");
            }
        });

        $("#id_tipo_asignatura").change(function() {
            // Código para recuperar las rúbricas de evaluación asociadas al aporte de evaluación seleccionado
            listarRubricasEvaluacion();
        });

        $('#btn_nuevo_insumo').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url(route_to('insumos_evaluacion_form_crear')) ?>",
                dataType: "json",
                success: function(response) {
                    // alert(response.data);
                    $('.viewmodal').html(response.data).show();
                    $('#nuevoInsumoModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function cargarAportesEvaluacion() {
        var id_periodo_evaluacion = $("#id_periodo_evaluacion").val();

        document.getElementById("id_aporte_evaluacion").length = 0;
        $('#id_aporte_evaluacion').append('<option value="">Seleccione...</option>');

        $(".viewdata").html("<tr><td colspan='4' align='center'>Debes seleccionar un aporte de evaluación...</td></tr>");

        $("#btn_nuevo_insumo").attr("disabled", true);

        if (id_periodo_evaluacion == "") {
            $(".viewdata").html("<tr><td colspan='4' align='center'>Debes seleccionar un periodo de evaluación...</td></tr>");
        } else {
            $.post("<?= base_url(route_to('aportes_evaluacion_select')) ?>", {
                    id_periodo_evaluacion: id_periodo_evaluacion
                },
                function(resultado) {
                    if (resultado == false) {
                        Swal.fire({
                            title: "Aviso",
                            text: "No se han definido Aportes de Evaluación todavía...",
                            icon: "info"
                        });
                        $("#id_aporte_evaluacion").attr("disabled", true);
                        $("#id_tipo_asignatura").attr("disabled", true);
                    } else {
                        $("#id_aporte_evaluacion").append(resultado);
                    }
                }
            );
        }
    }

    function listarRubricasEvaluacion() {
        var id_aporte = $("#id_aporte_evaluacion").val();
        var id_tipo = $("#id_tipo_asignatura").val();

        if (id_aporte == "") {
            $(".viewdata").html("<tr><td colspan='4' align='center'>Debes seleccionar un aporte de evaluación...</td></tr>");
            $("#btn_nuevo_insumo").attr("disabled", true);
        } else if (id_tipo == "") {
            $(".viewdata").html("<tr><td colspan='5' align='center'>Debes seleccionar un tipo de asignatura...</td></tr>");
            $("#btn_nuevo_insumo").attr("disabled", true);
        } else {
            $("#btn_nuevo_insumo").attr("disabled", false);

            $.ajax({
                type: "post",
                url: "<?= base_url(route_to('insumos_evaluacion_data')) ?>",
                data: {
                    id_aporte_evaluacion: id_aporte,
                    id_tipo_asignatura: id_tipo
                },
                dataType: "json",
                success: function(response) {
                    // console.log(JSON.stringify(response))
                    $('.viewdata').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }

    function edit(e, obj, id_rubrica_evaluacion) {
        e.preventDefault();

        const url = $(obj).attr("href");

        $.ajax({
            type: "post",
            url: url,
            data: {
                id_rubrica_evaluacion: id_rubrica_evaluacion
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewmodal').html(response.success).show();
                    $('#editarInsumoModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>