<!-- Editar Aporte Modal -->
<!-- Large modal -->
<div class="modal fade" id="editarAporteModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Aporte de Evaluación</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_update" action="<?= base_url(route_to('aportes_evaluacion_update')) ?>" autocomplete="off">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_aporte_evaluacion" id="id_aporte_evaluacion" value="<?= $id_aporte_evaluacion ?>">
                <input type="hidden" name="periodo_evaluacion_id" id="periodo_evaluacion_id" value="<?= $id_periodo_evaluacion ?>">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= old('nombre') ?? $ap_nombre ?>">
                            <p class="invalid-feedback error-nombre"></p>
                        </div>
                        <div class="col-6">
                            <label for="abreviatura" class="form-label">Abreviatura:</label>
                            <input type="text" class="form-control" name="abreviatura" id="abreviatura" value="<?= old('abreviatura') ?? $ap_abreviatura ?>">
                            <p class="invalid-feedback error-abreviatura"></p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?= old('descripcion') ?? $ap_descripcion ?>">
                        <p class="invalid-feedback error-descripcion"></p>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="id_tipo_aporte" class="form-label">Tipo de Aporte:</label>
                            <select class="form-select" id="id_tipo_aporte" name="id_tipo_aporte">
                                <?php
                                foreach ($tipos_aporte as $v) :
                                ?>
                                    <option value="<?= $v->id_tipo_aporte ?>" <?= $v->id_tipo_aporte == $id_tipo_aporte ? 'selected' : '' ?>><?= $v->ta_descripcion ?></option>
                                <?php endforeach ?>
                            </select>
                            <p class="invalid-feedback error-tipo-aporte"></p>
                        </div>
                        <div class="col-6">
                            <label for="ponderacion" class="form-label">Ponderación:</label>
                            <input type="number" min="0" max="1" step="0.01" class="form-control" value="<?= old('ponderacion') ?? $ap_ponderacion ?>" name="ponderacion" id="ponderacion">
                            <p class="invalid-feedback error-ponderacion"></p>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-6">
                            <div id="div_fecha_inicio" class="form-group">
                                <label for="fecha_inicio">Fecha de inicio:</label>
                                <div class="controls">
                                    <div class="input-group date">
                                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?= old('fecha_inicio') ?? $ap_fecha_apertura ?>">
                                        <p class="invalid-feedback error-fecha-inicio"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div id="div_fecha_fin" class="form-group">
                                <label for="fecha_fin">Fecha de fin:</label>
                                <div class="controls">
                                    <div class="input-group date">
                                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="<?= old('fecha_fin') ?? $ap_fecha_cierre ?>">
                                        <p class="invalid-feedback error-fecha-fin"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="submit" class="btn btn-success btnAgregar"><i class="fa fa-download"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Editar Aporte de Evaluación Modal -->

<script>
    $(document).ready(function() {
        $("#periodo_evaluacion_id").val($("#id_periodo_evaluacion").val());
        $("#form_update").submit(function(e) {
            e.preventDefault();
            id_periodo_evaluacion = $("#periodo_evaluacion_id").val();
            
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
                    $('.btnAgregar').html('<i class="fa fa-download"></i> Guardar');
                },
                success: function(response) {
                    // alert(JSON.stringify(response.errors.nombre))
                    if (response.errors) {
                        if (response.errors.nombre) {
                            $('#nombre').addClass('is-invalid');
                            $('.error-nombre').html(response.errors.nombre);
                        } else {
                            $('#nombre').removeClass('is-invalid');
                            $('.error-nombre').html('');
                        }

                        if (response.errors.abreviatura) {
                            $('#abreviatura').addClass('is-invalid');
                            $('.error-abreviatura').html(response.errors.abreviatura);
                        } else {
                            $('#abreviatura').removeClass('is-invalid');
                            $('.error-abreviatura').html('');
                        }

                        if (response.errors.descripcion) {
                            $('#descripcion').addClass('is-invalid');
                            $('.error-descripcion').html(response.errors.descripcion);
                        } else {
                            $('#descripcion').removeClass('is-invalid');
                            $('.error-descripcion').html('');
                        }

                        if (response.errors.id_tipo_aporte) {
                            $('#id_tipo_aporte').addClass('is-invalid');
                            $('.error-tipo-aporte').html(response.errors.id_tipo_aporte);
                        } else {
                            $('#id_tipo_aporte').removeClass('is-invalid');
                            $('.error-tipo-aporte').html('');
                        }

                        if (response.errors.ponderacion) {
                            $('#ponderacion').addClass('is-invalid');
                            $('.error-ponderacion').html(response.errors.ponderacion);
                        } else {
                            $('#ponderacion').removeClass('is-invalid');
                            $('.error-ponderacion').html('');
                        }

                        if (response.errors.fecha_inicio) {
                            $('#fecha_inicio').addClass('is-invalid');
                            $('.error-fecha-inicio').html(response.errors.fecha_inicio);
                        } else {
                            $('#fecha_inicio').removeClass('is-invalid');
                            $('.error-fecha-inicio').html('');
                        }

                        if (response.errors.fecha_fin) {
                            $('#fecha_fin').addClass('is-invalid');
                            $('.error-fecha-fin').html(response.errors.fecha_fin);
                        } else {
                            $('#fecha_fin').removeClass('is-invalid');
                            $('.error-fecha-fin').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Logrado!",
                            text: response.success,
                            icon: "success"
                        });

                        $('#editarAporteModal').modal('hide');
                        listarAportes(id_periodo_evaluacion);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>