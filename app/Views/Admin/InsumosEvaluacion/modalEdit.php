<!-- Editar Insumo Modal -->
<!-- Large modal -->
<div class="modal fade" id="editarInsumoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Insumo de Evaluación</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_update" action="<?= base_url(route_to('insumos_evaluacion_update')) ?>" autocomplete="off">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_rubrica_evaluacion" id="id_rubrica_evaluacion" value="<?= $id_rubrica_evaluacion ?>">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= old('nombre') ?? $ru_nombre ?>">
                            <p class="invalid-feedback error-nombre"></p>
                        </div>
                        <div class="col-6">
                            <label for="abreviatura" class="form-label">Abreviatura:</label>
                            <input type="text" class="form-control" name="abreviatura" id="abreviatura" value="<?= old('abreviatura') ?? $ru_abreviatura ?>">
                            <p class="invalid-feedback error-abreviatura"></p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?= old('descripcion') ?? $ru_descripcion ?>">
                        <p class="invalid-feedback error-descripcion"></p>
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
        $("#form_update").submit(function(e) {
            e.preventDefault();
            
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
                    } else {
                        Swal.fire({
                            title: "Logrado!",
                            text: response.success,
                            icon: "success"
                        });

                        $('#editarInsumoModal').modal('hide');
                        listarRubricasEvaluacion();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>