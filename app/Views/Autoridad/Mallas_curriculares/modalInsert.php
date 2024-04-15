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
                <input type="hidden" name="curso_id" id="curso_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_asignatura" class="form-label fw-bold">Asignaturas:</label>
                        <select class="form-select" id="id_asignatura" name="id_asignatura">
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
            $("#curso_id").val(id_curso);
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
                    // alert(JSON.stringify(response));
                    if (response.errors) {
                        if (response.errors.id_asignatura) {
                            $('#id_asignatura').addClass('is-invalid');
                            $('.errorAsignaturas').html(response.errors.id_asignatura);
                        } else {
                            $('#id_asignatura').removeClass('is-invalid');
                            $('.errorAsignaturas').html('');
                        }

                        if (response.errors.presenciales) {
                            $('#presenciales').addClass('is-invalid');
                            $('.errorPresenciales').html(response.errors.presenciales);
                        } else {
                            $('#presenciales').removeClass('is-invalid');
                            $('.errorPresenciales').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Logrado!",
                            text: response.success,
                            icon: "success"
                        });

                        $('#nuevoItemModal').modal('hide');
                        listarItems(id_curso);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>