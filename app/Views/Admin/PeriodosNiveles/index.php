<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Asociar Periodos Lectivos con Niveles de Educación
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2 p-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Asociar Periodos Lectivos con Niveles de Educación
        </div>
        <form id="form_insert" action="<?= base_url(route_to('periodos_niveles_store')) ?>" method="post">
            <div class="mb-2 mt-2 p-2 row">
                <label for="id_periodo_lectivo" class="col-2 control-label">Periodo Lectivo:</label>
                <div class="col-10">
                    <?php

                    use App\Models\Admin\PeriodosLectivosModel;

                    $periodoLectivoModel = new PeriodosLectivosModel();
                    ?>
                    <select class="form-select" name="id_periodo_lectivo" id="id_periodo_lectivo">
                        <option value="">Seleccione...</option>
                        <?php foreach ($modalidades as $modalidad) : ?>
                            <optgroup label="<?= $modalidad->mo_nombre; ?>">
                                <?php $periodos_lectivos = $periodoLectivoModel->listarPeriodosPorModalidad($modalidad->id_modalidad); ?>
                                <?php foreach ($periodos_lectivos as $periodo_lectivo) : ?>
                                    <?php
                                    $nombrePeriodoLectivo = fecha_corta($periodo_lectivo->pe_fecha_inicio) . " - " . fecha_corta($periodo_lectivo->pe_fecha_fin) . " [" . $periodo_lectivo->pe_descripcion . "]";
                                    ?>

                                    <option value="<?= $periodo_lectivo->id_periodo_lectivo ?>" <?= old('periodo') == $periodo_lectivo->id_periodo_lectivo ? 'selected' : '' ?>><?= $nombrePeriodoLectivo; ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        <?php endforeach ?>
                    </select>
                    <span class="invalid-feedback error-id_periodo_lectivo"></span>
                </div>
            </div>
            <div class="mb-2 p-2 row">
                <label for="id_nivel_educacion" class="col-2 control-label">Nivel de Educación:</label>
                <div class="col-10">
                    <select class="form-select" id="id_nivel_educacion" name="id_nivel_educacion">
                        <option value="">Seleccione...</option>
                        <?php
                        foreach ($niveles_educacion as $nivel) :
                        ?>
                            <option value="<?= $nivel->id_nivel_educacion ?>"><?= $nivel->nombre ?></option>
                        <?php endforeach ?>
                    </select>
                    <span class="invalid-feedback error-id_nivel_educacion"></span>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-12 d-grid gap-2">
                    <button id="btn-add-item" type="submit" class="btn btn-primary btnAgregar">
                        <i class="fa fa-download"></i> Asociar
                    </button>
                </div>
            </div>
        </form>
        <!-- Línea de división -->
        <hr>
        <!-- message -->
        <div id="text_message" class="text-center"></div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Periodo Lectivo</th>
                        <th>Nivel de Educación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="lista_items">
                    <!-- Aqui desplegamos el contenido de la base de datos -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $("#lista_items").html("<tr><td colspan='4' align='center'>Debe seleccionar un periodo lectivo...</td></tr>");

        toastr.options = {
            //primeras opciones
            "closeButton": false, //boton cerrar
            "debug": false,
            "newestOnTop": false, //notificaciones mas nuevas van en la parte superior
            "progressBar": true, //barra de progreso hasta que se oculta la notificacion
            "preventDuplicates": false, //para prevenir mensajes duplicados

            "onclick": null,

            //Posición de la notificación
            //toast-bottom-left, toast-bottom-right, toast-bottom-left, toast-top-full-width, toast-top-center
            "positionClass": "toast-top-center",

            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        };

        $("#id_periodo_lectivo").change(function() {
            var id_periodo_lectivo = $(this).val();
            if (id_periodo_lectivo == "")
                $("#lista_items").html("<tr><td colspan='4' align='center'>Debe seleccionar un periodo lectivo...</td></tr>");
            else
                listarNivelesAsociados(id_periodo_lectivo);
        });

        $("#form_insert").submit(function(e) {
            e.preventDefault();

            const id_periodo_lectivo = $("#id_periodo_lectivo").val();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnAgregar').attr('disable', 'disable');
                    $('.btnAgregar').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnAgregar').removeAttr('disable');
                    $('.btnAgregar').html('<i class="fa fa-download"></i> Asociar');
                },
                success: function(response) {
                    // alert(JSON.stringify(response))
                    if (response.errors) {
                        if (response.errors.id_periodo_lectivo) {
                            $('#id_periodo_lectivo').addClass('is-invalid');
                            $('.error-id_periodo_lectivo').html(response.errors.id_periodo_lectivo);
                        } else {
                            $('#id_periodo_lectivo').removeClass('is-invalid');
                            $('.error-id_periodo_lectivo').html('');
                        }

                        if (response.errors.id_nivel_educacion) {
                            $('#id_nivel_educacion').addClass('is-invalid');
                            $('.error-id_nivel_educacion').html(response.errors.id_nivel_educacion);
                        } else {
                            $('#id_nivel_educacion').removeClass('is-invalid');
                            $('.error-id_nivel_educacion').html('');
                        }
                    } else if (response.error) {
                        $('#id_periodo_lectivo').removeClass('is-invalid');
                        $('.error-id_periodo_lectivo').html('');

                        $('#id_nivel_educacion').removeClass('is-invalid');
                        $('.error-id_nivel_educacion').html('');

                        Swal.fire({
                            title: "Oops!",
                            text: response.error,
                            icon: "error"
                        });
                    } else {
                        $('#id_periodo_lectivo').removeClass('is-invalid');
                        $('.error-id_periodo_lectivo').html('');

                        $('#id_nivel_educacion').removeClass('is-invalid');
                        $('.error-id_nivel_educacion').html('');

                        toastr["success"](response.success, "Logrado!");

                        listarNivelesAsociados(id_periodo_lectivo);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('#lista_items').on('click', '.item-delete', function(e) {
            e.preventDefault();

            let id = $(this).attr('data');
            let id_periodo_lectivo = document.getElementById("id_periodo_lectivo").value;

            $("#text_message").html("<img src='<?php echo base_url(); ?>Assets/img/ajax-loader-blue.GIF' alt='procesando...' />");

            $.ajax({
                url: "<?= base_url(route_to('periodos_niveles_delete')) ?>",
                method: "post",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $("#text_message").html("");

                    toastr[response.icon](response.message, response.title);

                    listarNivelesAsociados(id_periodo_lectivo);
                },
                error: function(jqXHR, textStatus) {
                    alert(jqXHR.responseText);
                }
            });
        });
    });

    function listarNivelesAsociados(id_periodo_lectivo) {
        $('#id_periodo_lectivo').removeClass('is-invalid');
        $('.error-id_periodo_lectivo').html('');

        $('#id_nivel_educacion').removeClass('is-invalid');
        $('.error-id_nivel_educacion').html('');

        var request = $.ajax({
            url: "<?= base_url(route_to('periodos_niveles_data')) ?>",
            method: "post",
            data: {
                id_periodo_lectivo: id_periodo_lectivo
            },
            dataType: "json"
        });

        request.done(function(data) {
            var html = '';
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + data[i].id_periodo_nivel + '</td>' +
                        '<td>[' + data[i].mo_nombre + "] - " + data[i].pe_fecha_inicio + ' a ' + data[i].pe_fecha_fin + '</td>' +
                        '<td>' + data[i].nombre + '</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<a href="javascript:;" class="btn btn-danger btn-sm item-delete" data="' + data[i].id_periodo_nivel +
                        '" title="Eliminar"><span class="fa fa-trash"></span></a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                }
                $("#lista_items").html(html);
            } else {
                $("#lista_items").html("<tr><td colspan='4' align='center'>No se han asociado niveles de educación a este periodo lectivo...</td></tr>");
            }
        });

        request.fail(function(jqXHR, textStatus) {
            alert("Requerimiento fallido: " + jqXHR.responseText);
        });
    }
</script>
<?= $this->endsection('scripts') ?>