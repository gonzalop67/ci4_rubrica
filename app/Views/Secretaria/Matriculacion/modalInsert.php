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
                <div class="modal-body">
                    <div class="mb-1 row">
                        <label for="new_id_tipo_documento" class="col-sm-2 col-form-label">Tipo de Documento:</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="new_id_tipo_documento" name="new_id_tipo_documento" required>
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($tipos_documentos as $v) :
                                ?>
                                    <option value="<?= $v->id_tipo_documento ?>"><?= $v->td_nombre ?></option>
                                <?php endforeach ?>
                            </select>
                            <span id="mensaje2" style="color: #e73d4a"></span>
                        </div>
                        <label for="new_dni" class="col-sm-1 col-form-label">DNI:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="new_dni" name="new_dni" value="">
                            <span id="mensaje3" style="color: #e73d4a"></span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="new_apellidos" class="col-sm-2 col-form-label">Apellidos:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mayusculas" id="new_apellidos" name="new_apellidos" value="">
                            <span id="mensaje4" style="color: #e73d4a"></span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="new_nombres" class="col-sm-2 col-form-label">Nombres:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mayusculas" id="new_nombres" name="new_nombres" value="">
                            <span id="mensaje5" style="color: #e73d4a"></span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="new_fec_nac" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="new_fec_nac" name="new_fec_nac" value="" placeholder="aaaa-mm-dd" maxlength="10">
                            <span id="mensaje6" style="color: #e73d4a"></span>
                        </div>

                        <label for="new_edad" class="col-sm-1 col-form-label">Edad:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="new_edad" name="new_edad" value="" disabled>
                            <span id="mensaje6" style="color: #e73d4a"></span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="new_direccion" class="col-sm-2 col-form-label">Dirección:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mayusculas" id="new_direccion" name="new_direccion" value="">
                            <span id="mensaje7" style="color: #e73d4a"></span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="new_sector" class="col-sm-2 col-form-label">Sector:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control mayusculas" id="new_sector" name="new_sector" value="">
                            <span id="mensaje8" style="color: #e73d4a"></span>
                        </div>
                        <label for="new_telefono" class="col-sm-1 col-form-label">Celular:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="new_telefono" name="new_telefono" value="">
                            <span id="mensaje9" style="color: #e73d4a"></span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="new_email" class="col-sm-2 col-form-label">E-mail:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="new_email" name="new_email" value="">
                            <span id="mensaje10" style="color: #e73d4a"></span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="new_genero" class="col-sm-2 col-form-label">Género:</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="new_genero" name="new_genero">
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($def_generos as $v) :
                                ?>
                                    <option value="<?= $v->id_def_genero ?>"><?= $v->dg_nombre ?></option>
                                <?php endforeach ?>
                            </select>
                            <span id="mensaje11" style="color: #e73d4a"></span>
                        </div>
                        <label for="new_nacionalidad" class="col-sm-2 col-form-label">Nacionalidad:</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="new_nacionalidad" name="new_nacionalidad">
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($def_nacionalidades as $v) :
                                ?>
                                    <option value="<?= $v->id_def_nacionalidad ?>"><?= $v->dn_nombre ?></option>
                                <?php endforeach ?>
                            </select>
                            <span id="mensaje12" style="color: #e73d4a"></span>
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
