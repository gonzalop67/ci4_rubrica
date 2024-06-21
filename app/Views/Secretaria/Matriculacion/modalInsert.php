<!-- New Student Modal -->
<!-- Large modal -->
<div class="modal fade" id="newStudentModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Estudiante Nuevo</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_insert" action="<?= base_url(route_to('matriculacion_store')) ?>" autocomplete="off">
                <?= csrf_field(); ?>
                <input type="hidden" name="paralelo_id" id="paralelo_id">
                <div class="modal-body">
                    <div class="mb-1 row">
                        <label for="id_tipo_documento" class="col-sm-2 col-form-label">Tipo de Documento:</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="id_tipo_documento" name="id_tipo_documento">
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($tipos_documentos as $v) :
                                ?>
                                    <option value="<?= $v->id_tipo_documento ?>"><?= $v->td_nombre ?></option>
                                <?php endforeach ?>
                            </select>
                            <p class="invalid-feedback errorTipoDocumento"></p>
                        </div>
                        <label for="dni" class="col-sm-1 col-form-label">DNI:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="dni" name="dni" value="">
                            <p class="invalid-feedback errorDNI"></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="apellidos" class="col-sm-2 col-form-label">Apellidos:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mayusculas" id="apellidos" name="apellidos" value="">
                            <p class="invalid-feedback errorApellidos"></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="nombres" class="col-sm-2 col-form-label">Nombres:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mayusculas" id="nombres" name="nombres" value="">
                            <p class="invalid-feedback errorNombres"></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="fec_nac" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="fec_nac" name="fec_nac" value="" placeholder="aaaa-mm-dd" maxlength="10">
                            <p class="invalid-feedback errorFecNac"></p>
                        </div>

                        <label for="edad" class="col-sm-1 col-form-label">Edad:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="edad" name="edad" value="" disabled>
                            <p class="invalid-feedback errorEdad"></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="direccion" class="col-sm-2 col-form-label">Dirección:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mayusculas" id="direccion" name="direccion" value="">
                            <p class="invalid-feedback errorDireccion"></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="sector" class="col-sm-2 col-form-label">Sector:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control mayusculas" id="sector" name="sector" value="">
                            <p class="invalid-feedback errorSector"></p>
                        </div>
                        <label for="telefono" class="col-sm-1 col-form-label">Celular:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="telefono" name="telefono" value="">
                            <p class="invalid-feedback errorTelefono"></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="">
                            <p class="invalid-feedback errorEmail"></p>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="genero" class="col-sm-2 col-form-label">Género:</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="genero" name="genero">
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($def_generos as $v) :
                                ?>
                                    <option value="<?= $v->id_def_genero ?>"><?= $v->dg_nombre ?></option>
                                <?php endforeach ?>
                            </select>
                            <p class="invalid-feedback errorGenero"></p>
                        </div>
                        <label for="nacionalidad" class="col-sm-2 col-form-label">Nacionalidad:</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="nacionalidad" name="nacionalidad">
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($def_nacionalidades as $v) :
                                ?>
                                    <option value="<?= $v->id_def_nacionalidad ?>"><?= $v->dn_nombre ?></option>
                                <?php endforeach ?>
                            </select>
                            <p class="invalid-feedback errorNacionalidad"></p>
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

<script>
    $(document).ready(function() {
        $("#paralelo_id").val($("#id_paralelo").val());
        let id_paralelo = $("#paralelo_id").val();

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
                    if (response.error) {
                        if (response.error.id_tipo_documento) {
                            $('#id_tipo_documento').addClass('is-invalid');
                            $('.errorTipoDocumento').html(response.error.id_tipo_documento);
                        } else {
                            $('#id_tipo_documento').removeClass('is-invalid');
                            $('.errorTipoDocumento').html('');
                        }

                        if (response.error.dni) {
                            $('#dni').addClass('is-invalid');
                            $('.errorDNI').html(response.error.dni);
                        } else {
                            $('#dni').removeClass('is-invalid');
                            $('.errorDNI').html('');
                        }

                        if (response.error.apellidos) {
                            $('#apellidos').addClass('is-invalid');
                            $('.errorApellidos').html(response.error.apellidos);
                        } else {
                            $('#apellidos').removeClass('is-invalid');
                            $('.errorApellidos').html('');
                        }

                        if (response.error.nombres) {
                            $('#nombres').addClass('is-invalid');
                            $('.errorNombres').html(response.error.nombres);
                        } else {
                            $('#nombres').removeClass('is-invalid');
                            $('.errorNombres').html('');
                        }

                        if (response.error.fec_nac) {
                            $('#fec_nac').addClass('is-invalid');
                            $('.errorFecNac').html(response.error.fec_nac);
                        } else {
                            $('#fec_nac').removeClass('is-invalid');
                            $('.errorFecNac').html('');
                        }

                        if (response.error.direccion) {
                            $('#direccion').addClass('is-invalid');
                            $('.errorDireccion').html(response.error.direccion);
                        } else {
                            $('#direccion').removeClass('is-invalid');
                            $('.errorDireccion').html('');
                        }

                        if (response.error.sector) {
                            $('#sector').addClass('is-invalid');
                            $('.errorSector').html(response.error.sector);
                        } else {
                            $('#sector').removeClass('is-invalid');
                            $('.errorSector').html('');
                        }

                        if (response.error.telefono) {
                            $('#telefono').addClass('is-invalid');
                            $('.errorTelefono').html(response.error.telefono);
                        } else {
                            $('#telefono').removeClass('is-invalid');
                            $('.errorTelefono').html('');
                        }

                        if (response.error.genero) {
                            $('#genero').addClass('is-invalid');
                            $('.errorGenero').html(response.error.genero);
                        } else {
                            $('#genero').removeClass('is-invalid');
                            $('.errorGenero').html('');
                        }

                        if (response.error.nacionalidad) {
                            $('#nacionalidad').addClass('is-invalid');
                            $('.errorNacionalidad').html(response.error.nacionalidad);
                        } else {
                            $('#nacionalidad').removeClass('is-invalid');
                            $('.errorNacionalidad').html('');
                        }
                    } else {
                        Swal.fire({
                            title: response.titulo,
                            text: response.mensaje,
                            icon: response.tipo_mensaje
                        });

                        $('#newStudentModal').modal('hide');
                        listarEstudiantesParalelo(id_paralelo);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

    });
</script>