<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Crear Un Usuario
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<style>
.hide {
    display: none;
}
</style>
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2 mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Crear Nuevo Usuario
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('usuarios_store')) ?>" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="abreviatura" class="form-label">Título Abreviatura:</label>
                    <input type="text" class="form-control <?= session('errors.abreviatura') ? 'is-invalid' : '' ?>" value="<?= old('abreviatura') ?>" name="abreviatura" id="abreviatura" placeholder="Abreviatura del Título" autofocus>
                    <p class="invalid-feedback"><?= session('errors.abreviatura') ?></p>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Título Descripcion:</label>
                    <input type="text" class="form-control <?= session('errors.descripcion') ? 'is-invalid' : '' ?>" value="<?= old('descripcion') ?>" name="descripcion" id="descripcion" placeholder="Descripción del Título">
                    <p class="invalid-feedback"><?= session('errors.descripcion') ?></p>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control <?= session('errors.apellidos') ? 'is-invalid' : '' ?>" value="<?= old('apellidos') ?>" name="apellidos" id="apellidos" placeholder="Apellidos del Usuario">
                    <p class="invalid-feedback"><?= session('errors.apellidos') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres:</label>
                    <input type="text" class="form-control <?= session('errors.nombres') ? 'is-invalid' : '' ?>" value="<?= old('nombres') ?>" name="nombres" id="nombres" placeholder="Nombres del Usuario">
                    <p class="invalid-feedback"><?= session('errors.nombres') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombre_corto" class="form-label">Nombre Corto:</label>
                    <input type="text" class="form-control <?= session('errors.nombre_corto') ? 'is-invalid' : '' ?>" value="<?= old('nombre_corto') ?>" name="nombre_corto" id="nombre_corto" placeholder="Nombre Corto del Usuario">
                    <p class="invalid-feedback"><?= session('errors.nombre_corto') ?></p>
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" class="form-control <?= session('errors.usuario') ? 'is-invalid' : '' ?>" value="<?= old('usuario') ?>" name="usuario" id="usuario" placeholder="Nombre de Usuario">
                    <p class="invalid-feedback"><?= session('errors.usuario') ?></p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="text" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" value="<?= old('password') ?>" name="password" id="password" placeholder="Clave del Usuario">
                    <p class="invalid-feedback"><?= session('errors.password') ?></p>
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género:</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.genero') ?></p>
                </div>
                <div class="mb-3">
                    <label for="activo" class="form-label">Activo:</label>
                    <select class="form-select" id="activo" name="activo">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.activo') ?></p>
                </div>
                <div class="mb-3">
                    <label for="perfiles" class="form-label">Perfil:</label>
                    <?php foreach ($perfiles as $v) : ?>
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="perfiles[]" value="<?= $v->id_perfil ?>"
                                <?= 
                                    old('perfiles.*')
                                        ? 
                                            (in_array($v->id_perfil, old('perfiles.*'))
                                                ? 'checked'
                                                : '')
                                        : ''
                                ?>
                                >
                                <?= $v->pe_nombre ?>
                            </label>
                        </div>
                    <?php endforeach ?>
                    <p class="invalid-feedback"><?= session('errors')['perfiles.*'] ?? '' ?></p>
                </div>
                <div id="img_upload">
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <div id="img_div" class="hide">
                            <img id="avatar" name="avatar" class="img-thumbnail" width="75">
                        </div>
                    </div>
                    <div class="mb-3">
                        <!-- <label for="foto" class="form-label"></label> -->
                        <input type="file" name="foto" id="foto" class="<?= session('errors.foto') ? 'is-invalid' : '' ?>">
                        <p class="invalid-feedback"><?= session('errors.foto') ?></p>
                    </div>
                </div>
                <!-- <?php var_dump(session('errors.foto')) ?> -->
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('usuarios')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $("#foto").change(function() {
            $("#img_div").removeClass("hide");
            filePreview(this);
        });

        $("#abreviatura").blur(function() {
            let abreviatura = $(this).val();
            let apellidos = $("#apellidos").val();
            let nombres = $("#nombres").val();

            let vec_apellidos = apellidos.split(" ");
            let vec_nombres = nombres.split(" ");
            $("#nombre_corto").val(abreviatura + " " + vec_nombres[0] + " " + vec_apellidos[0]);
        });

        $("#apellidos").blur(function() {
            let abreviatura = $("#abreviatura").val();
            let apellidos = $(this).val();
            let nombres = $("#nombres").val();

            let vec_apellidos = apellidos.split(" ");
            let vec_nombres = nombres.split(" ");
            $("#nombre_corto").val(abreviatura + " " + vec_nombres[0] + " " + vec_apellidos[0]);
        });

        $("#nombres").blur(function() {
            let abreviatura = $("#abreviatura").val();
            let apellidos = $("#apellidos").val();
            let nombres = $(this).val();

            let vec_apellidos = apellidos.split(" ");
            let vec_nombres = nombres.split(" ");
            $("#nombre_corto").val(abreviatura + " " + vec_nombres[0] + " " + vec_apellidos[0]);
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
</script>
<?= $this->endsection('scripts') ?>