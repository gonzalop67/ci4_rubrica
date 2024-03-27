<!-- Nuevo Aporte Modal -->
<!-- Large modal -->
<div class="modal fade" id="nuevoAporteModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Aporte de Evaluación</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_insert" action="<?= base_url(route_to('aportes_evaluacion_store')) ?>" autocomplete="off">
                <?= csrf_field(); ?>
                <input type="hidden" name="periodo_evaluacion_id" id="periodo_evaluacion_id">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="" required>
                            <p class="invalid-feedback error-nombre"></p>
                        </div>
                        <div class="col-6">
                            <label for="abreviatura" class="form-label">Abreviatura:</label>
                            <input type="text" class="form-control" name="abreviatura" id="abreviatura" value="" required>
                            <p class="invalid-feedback error-abreviatura"></p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" value="" required>
                        <p class="invalid-feedback error-descripcion"></p>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="id_tipo_aporte" class="form-label">Tipo de Aporte:</label>
                            <select class="form-select" id="id_tipo_aporte" name="id_tipo_aporte" required>
                                <?php
                                foreach ($tipos_aporte as $v) :
                                ?>
                                    <option value="<?= $v->id_tipo_aporte ?>"><?= $v->ta_descripcion ?></option>
                                <?php endforeach ?>
                            </select>
                            <p class="invalid-feedback error-tipoaporte"></p>
                        </div>
                        <div class="col-6">
                            <label for="ponderacion" class="form-label">Ponderación:</label>
                            <input type="number" min="0" max="1" step="0.01" class="form-control" value="" name="ponderacion" id="ponderacion" required>
                            <p class="invalid-feedback error-ponderacion"></p>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-6">
                            <div id="div_pe_fecha_inicio" class="form-group">
                                <label for="pe_fecha_inicio">Fecha de inicio:</label>
                                <div class="controls">
                                    <div class="input-group date">
                                        <input type="date" name="pe_fecha_inicio" id="pe_fecha_inicio" class="form-control" value="" required>
                                        <p class="invalid-feedback error-fecha-inicial"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div id="div_pe_fecha_fin" class="form-group">
                                <label for="pe_fecha_fin">Fecha de fin:</label>
                                <div class="controls">
                                    <div class="input-group date">
                                        <input type="date" name="pe_fecha_fin" id="pe_fecha_fin" class="form-control" value="" required>
                                        <p class="invalid-feedback error-fecha-final"></p>
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
<!-- Fin Nuevo Aporte de Evaluación Modal -->

<script>
    $(document).ready(function() {
        $("#periodo_evaluacion_id").val($("#id_periodo_evaluacion").val());
        $("#form_insert").submit(function(e) {
            e.preventDefault();
            id_periodo_evaluacion = $("#periodo_evaluacion_id").val();
            alert(id_periodo_evaluacion);
            /* $.ajax({
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
                    if (response.error) {
                        if (response.error.nombre) {
                            $('#nombre').addClass('is-invalid');
                            $('.errornombre').html(response.error.nombre);
                        } else {
                            $('#nombre').removeClass('is-invalid');
                            $('.errornombre').html('');
                        }

                        if (response.error.abreviatura) {
                            $('#abreviatura').addClass('is-invalid');
                            $('.errorabreviatura').html(response.error.abreviatura);
                        } else {
                            $('#abreviatura').removeClass('is-invalid');
                            $('.errorabreviatura').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Logrado!",
                            text: response.success,
                            icon: "success"
                        });

                        $('#nuevoMenuModal').modal('hide');
                        listarMenus(id_perfil);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            }); */
        });
    });
</script>