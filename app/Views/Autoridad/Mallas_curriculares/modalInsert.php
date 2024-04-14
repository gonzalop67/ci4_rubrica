<!-- Nuevo Item de Malla Curricular Modal -->
<!-- Large modal -->
<div class="modal fade" id="nuevoItemModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Item de Malla Curricular</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_insert" action="<?= base_url(route_to('mallas_curriculares_store')) ?>" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="asignaturas" class="form-label fw-bold">Asignaturas:</label>
                        <select class="form-select" id="asignaturas" name="asignaturas" required>
                            <option value="">Seleccione...</option>
                            <?php 
                            foreach ($asignaturas as $v) { ?>
                                <option value="<?= $v->id_asignatura ?>"><?= $v->as_nombre ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                        <p class="invalid-feedback errorAsignaturas"></p>
                    </div>
                    <div class="mb-3">
                        <label for="presenciales" class="form-label fw-bold">Horas Presenciales:</label>
                        <input type="number" min="1" step="1" class="form-control" name="presenciales" id="presenciales" value="1" required>
                        <p class="invalid-feedback errorPresenciales"></p>
                    </div>
                    <div class="mb-3">
                        <label for="autonomas" class="form-label fw-bold">Horas Autónomas:</label>
                        <input type="number" min="0" step="1" class="form-control" name="autonomas" id="autonomas" value="0">
                        <p class="invalid-feedback errorAutonomas"></p>
                    </div>
                    <div class="mb-3">
                        <label for="tutorias" class="form-label fw-bold">Horas de Tutorías:</label>
                        <input type="number" min="0" step="1" class="form-control" name="tutorias" id="tutorias" value="0">
                        <p class="invalid-feedback errorTutorias"></p>
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
<!-- Fin Nuevo Item de Malla Curricular Modal -->

<script>
    $(document).ready(function() {
        $("#form_insert").submit(function(e) {
            e.preventDefault();
            id_curso = $("#id_curso").val();
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
                    if (response.error) {
                        if (response.error.texto) {
                            $('#texto').addClass('is-invalid');
                            $('.errorTexto').html(response.error.texto);
                        } else {
                            $('#texto').removeClass('is-invalid');
                            $('.errorTexto').html('');
                        }

                        if (response.error.enlace) {
                            $('#enlace').addClass('is-invalid');
                            $('.errorEnlace').html(response.error.enlace);
                        } else {
                            $('#enlace').removeClass('is-invalid');
                            $('.errorEnlace').html('');
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
            });
        });
    });
</script>