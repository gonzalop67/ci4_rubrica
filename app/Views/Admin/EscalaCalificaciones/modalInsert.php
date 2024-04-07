<!-- Nueva Escala Modal -->
<!-- Large modal -->
<div class="modal fade" id="nuevaEscalaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Escala de Calificación</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_insert" action="<?= base_url(route_to('escalas_calificaciones_store')) ?>" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="cualitativa" class="form-label">Escala Cualitativa:</label>
                        <textarea rows="2" class="form-control" name="cualitativa" id="cualitativa"></textarea>
                        <p class="invalid-feedback error-cualitativa"></p>
                    </div>
                    <div class="mb-2">
                        <label for="cuantitativa" class="form-label">Escala Cuantitativa:</label>
                        <input type="text" class="form-control" name="cuantitativa" id="cuantitativa" value="">
                        <p class="invalid-feedback error-cuantitativa"></p>
                    </div>
                    <div class="row">
                        <div class="mb-2 col-4">
                            <label for="nota_minima" class="form-label">Nota Mínima:</label>
                            <input type="number" step="any" min="0" max="10" class="form-control" name="nota_minima" id="nota_minima" value="">
                            <p class="invalid-feedback error-nota-minima"></p>
                        </div>
                        <div class="mb-2 col-4">
                            <label for="nota_maxima" class="form-label">Nota Máxima:</label>
                            <input type="number" step="any" min="0" max="10" class="form-control" name="nota_maxima" id="nota_maxima" value="">
                            <p class="invalid-feedback error-nota-maxima"></p>
                        </div>
                        <div class="mb-2 col-4">
                            <label for="equivalencia" class="form-label">Equivalencia:</label>
                            <input type="text" class="form-control" name="equivalencia" id="equivalencia" value="">
                            <p class="invalid-feedback error-equivalencia"></p>
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
        $("#form_insert").submit(function(e) {
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
                    // alert(JSON.stringify(response.errors.cualitativa))
                    if (response.errors) {
                        if (response.errors.cualitativa) {
                            $('#cualitativa').addClass('is-invalid');
                            $('.error-cualitativa').html(response.errors.cualitativa);
                        } else {
                            $('#cualitativa').removeClass('is-invalid');
                            $('.error-cualitativa').html('');
                        }

                        if (response.errors.cuantitativa) {
                            $('#cuantitativa').addClass('is-invalid');
                            $('.error-cuantitativa').html(response.errors.cuantitativa);
                        } else {
                            $('#cuantitativa').removeClass('is-invalid');
                            $('.error-cuantitativa').html('');
                        }

                        if (response.errors.nota_minima) {
                            $('#nota_minima').addClass('is-invalid');
                            $('.error-nota-minima').html(response.errors.nota_minima);
                        } else {
                            $('#nota_minima').removeClass('is-invalid');
                            $('.error-nota-minima').html('');
                        }

                        if (response.errors.nota_maxima) {
                            $('#nota_maxima').addClass('is-invalid');
                            $('.error-nota-maxima').html(response.errors.nota_maxima);
                        } else {
                            $('#nota_maxima').removeClass('is-invalid');
                            $('.error-nota-maxima').html('');
                        }

                        if (response.errors.equivalencia) {
                            $('#equivalencia').addClass('is-invalid');
                            $('.error-equivalencia').html(response.errors.equivalencia);
                        } else {
                            $('#equivalencia').removeClass('is-invalid');
                            $('.error-equivalencia').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Logrado!",
                            text: response.success,
                            icon: "success"
                        });

                        $('#nuevaEscalaModal').modal('hide');
                        listarEscalasCalificaciones();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>