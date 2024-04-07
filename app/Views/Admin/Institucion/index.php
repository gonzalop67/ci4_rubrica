<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Datos de la IE
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Administración de Datos de la Institución Educativa</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-building-columns me-1"></i>
            Datos de la Institución Educativa
        </div>
        <div class="card-body">
            <?php if (session('msg')) : ?>
                <div class="alert alert-<?= session('msg.type') ?> alert-dismissible fade show" role="alert">
                    <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <form action="<?= base_url(route_to('institucion_update')) ?>" enctype="multipart/form-data" method="post">
                <div class="row mb-2">
                    <div class="col-12">
                        <label for="nombre" class="form-label fw-bold">Nombre:</label>
                        <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?? $institucion->in_nombre ?>" name="nombre" id="nombre" autofocus required>
                        <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label for="direccion" class="form-label fw-bold">Dirección:</label>
                        <input type="text" class="form-control <?= session('errors.direccion') ? 'is-invalid' : '' ?>" value="<?= old('direccion') ?? $institucion->in_direccion ?>" name="direccion" id="direccion" required>
                        <p class="invalid-feedback"><?= session('errors.direccion') ?></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="telefono" class="form-label fw-bold">Teléfono:</label>
                        <input type="text" class="form-control <?= session('errors.telefono') ? 'is-invalid' : '' ?>" value="<?= old('telefono') ?? $institucion->in_telefono ?>" name="telefono" id="telefono" required>
                        <p class="invalid-feedback"><?= session('errors.telefono') ?></p>
                    </div>
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="regimen" class="form-label fw-bold">Régimen:</label>
                        <input type="text" class="form-control <?= session('errors.regimen') ? 'is-invalid' : '' ?>" value="<?= old('regimen') ?? $institucion->in_regimen ?>" name="regimen" id="regimen" required>
                        <p class="invalid-feedback"><?= session('errors.regimen') ?></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="rector" class="form-label fw-bold">Rector:</label>
                        <input type="text" class="form-control <?= session('errors.rector') ? 'is-invalid' : '' ?>" value="<?= old('rector') ?? $institucion->in_nom_rector ?>" name="rector" id="rector" required>
                        <p class="invalid-feedback"><?= session('errors.rector') ?></p>
                    </div>
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="rector_genero" class="form-label fw-bold">Género:</label>
                        <select class="form-select" id="rector_genero" name="rector_genero">
                            <option value="F" <?= $institucion->in_genero_rector == "F" ? 'selected' : '' ?>>Femenino</option>
                            <option value="M" <?= $institucion->in_genero_rector == "M" ? 'selected' : '' ?>>Masculino</option>
                        </select>
                        <p class="invalid-feedback"><?= session('errors.rector_genero') ?></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="vicerrector" class="form-label fw-bold">Vicerrector:</label>
                        <input type="text" class="form-control <?= session('errors.vicerrector') ? 'is-invalid' : '' ?>" value="<?= old('vicerrector') ?? $institucion->in_nom_vicerrector ?>" name="vicerrector" id="vicerrector" required>
                        <p class="invalid-feedback"><?= session('errors.vicerrector') ?></p>
                    </div>
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="vicerrector_genero" class="form-label fw-bold">Género:</label>
                        <select class="form-select" id="vicerrector_genero" name="vicerrector_genero">
                            <option value="F" <?= $institucion->in_genero_rector == "F" ? 'selected' : '' ?>>Femenino</option>
                            <option value="M" <?= $institucion->in_genero_rector == "M" ? 'selected' : '' ?>>Masculino</option>
                        </select>
                        <p class="invalid-feedback"><?= session('errors.vicerrector_genero') ?></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="secretario" class="form-label fw-bold">Secretario:</label>
                        <input type="text" class="form-control <?= session('errors.secretario') ? 'is-invalid' : '' ?>" value="<?= old('secretario') ?? $institucion->in_nom_secretario ?>" name="secretario" id="secretario" required>
                        <p class="invalid-feedback"><?= session('errors.secretario') ?></p>
                    </div>
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="secretario_genero" class="form-label fw-bold">Género:</label>
                        <select class="form-select" id="secretario_genero" name="secretario_genero">
                            <option value="F" <?= $institucion->in_genero_secretario == "F" ? 'selected' : '' ?>>Femenino</option>
                            <option value="M" <?= $institucion->in_genero_secretario == "M" ? 'selected' : '' ?>>Masculino</option>
                        </select>
                        <p class="invalid-feedback"><?= session('errors.secretario_genero') ?></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="url" class="form-label fw-bold">URL:</label>
                        <input type="text" class="form-control <?= session('errors.url') ? 'is-invalid' : '' ?>" value="<?= old('url') ?? $institucion->in_url ?>" name="url" id="url" required>
                        <p class="invalid-feedback"><?= session('errors.url') ?></p>
                    </div>
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="amie" class="form-label fw-bold">AMIE:</label>
                        <input type="text" class="form-control <?= session('errors.amie') ? 'is-invalid' : '' ?>" value="<?= old('amie') ?? $institucion->in_amie ?>" name="amie" id="amie" required>
                        <p class="invalid-feedback"><?= session('errors.amie') ?></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="ciudad" class="form-label fw-bold">Ciudad:</label>
                        <input type="text" class="form-control <?= session('errors.ciudad') ? 'is-invalid' : '' ?>" value="<?= old('ciudad') ?? $institucion->in_ciudad ?>" name="ciudad" id="ciudad" required>
                        <p class="invalid-feedback"><?= session('errors.ciudad') ?></p>
                    </div>
                    <div class="col-6 col-sm-12 col-md-6">
                        <label for="copiar_y_pegar" class="form-label fw-bold">Copy & Paste:</label><br>
                        <input type="checkbox" id="copiar_y_pegar" name="copiar_y_pegar" <?php echo ($institucion->in_copiar_y_pegar == 1) ? "checked" : "" ?> onclick="actualizar_estado_copiar_y_pegar(this)">
                    </div>
                </div>
                <div id="img_upload">
                    <div class="mb-3">
                        <label for="logo" class="form-label fw-bold">Logo</label>
                        <?php if ($institucion->in_logo != '') : ?>
                            <div id="img_div">
                                <img src="<?= base_url() . "avatars/" . $institucion->in_logo; ?>" id="avatar" name="avatar" class="img-thumbnail" width="75">
                            </div>
                        <?php else : ?>
                            <div id="img_div" class="hide">
                                <img id="avatar" name="avatar" class="img-thumbnail" width="75">
                            </div>
                        <?php endif ?>
                        <input type="hidden" name="imagen_institucion_oculta" value="<?= $institucion->in_logo ?>" />
                    </div>
                    <div class="mb-3">
                        <input type="file" name="logo" id="logo" class="<?= session('errors.logo') ? 'is-invalid' : '' ?>">
                        <p class="invalid-feedback"><?= session('errors.logo') ?></p>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Actualizar los datos de la institución</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $("#logo").change(function() {
            $("#img_div").removeClass("hide");
            filePreview(this);
        });

    });

    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                $("#avatar").attr("src", e.target.result);
            }
        }
    }

    function actualizar_estado_copiar_y_pegar(obj) {
        if (obj.checked) estado_copiar_y_pegar = "1";
        else estado_copiar_y_pegar = "0";
        $.ajax({
            type: "POST",
            url: "<?= base_url(route_to('institucion_actualizar_estado_copiar_y_pegar')) ?>",
            data: "in_copiar_y_pegar=" + estado_copiar_y_pegar,
            dataType: "json",
            success: function(response) {
                console.log(response.mensaje);
                toastr[response.tipo_mensaje](response.mensaje, response.titulo);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>