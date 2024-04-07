<!-- Nuevo Menu Modal -->
<!-- Large modal -->
<div class="modal fade" id="nuevoMenuModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Menú</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_insert" action="<?= base_url(route_to('menus_store')) ?>" autocomplete="off">
                <?= csrf_field(); ?>
                <input type="hidden" name="perfil_id" id="perfil_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="texto" class="form-label">Texto:</label>
                        <input type="text" class="form-control" name="texto" id="texto">
                        <p class="invalid-feedback errorTexto"></p>
                    </div>
                    <div class="mb-3">
                        <label for="enlace" class="form-label">Enlace:</label>
                        <input type="text" class="form-control" name="enlace" id="enlace">
                        <p class="invalid-feedback errorEnlace"></p>
                    </div>
                    <div class="mb-3">
                        <label for="publicado" class="form-label">Publicado:</label>
                        <select class="form-select" id="publicado" name="publicado">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                        <p class="invalid-feedback errorPublicado"></p>
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
<!-- Fin Nueva Modalidad Modal -->

<script>
    $(document).ready(function() {
        $("#perfil_id").val($("#id_perfil").val());
        $("#form_insert").submit(function(e) {
            e.preventDefault();
            id_perfil = $("#perfil_id").val();
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