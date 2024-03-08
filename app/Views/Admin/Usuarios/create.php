<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Crear Un Usuario
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<style>
.img-thumbnail {
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
          box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
}
</style>
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Crear un nuevo Usuario</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Nuevo Usuario
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('usuarios_store')) ?>" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="abreviatura" class="form-label">Título Abreviatura:</label>
                    <input type="text" class="form-control <?= session('errors.abreviatura') ? 'is-invalid' : '' ?>" value="<?= old('abreviatura') ?>" name="abreviatura" id="abreviatura" placeholder="Abreviatura del Título" autofocus required>
                    <p class="invalid-feedback"><?= session('errors.abreviatura') ?></p>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Título Descripcion:</label>
                    <input type="text" class="form-control <?= session('errors.descripcion') ? 'is-invalid' : '' ?>" value="<?= old('descripcion') ?>" name="descripcion" id="descripcion" placeholder="Descripción del Título" required>
                    <p class="invalid-feedback"><?= session('errors.descripcion') ?></p>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control <?= session('errors.apellidos') ? 'is-invalid' : '' ?>" value="<?= old('apellidos') ?>" name="apellidos" id="apellidos" placeholder="Apellidos del Usuario" required>
                    <p class="invalid-feedback"><?= session('errors.apellidos') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres:</label>
                    <input type="text" class="form-control <?= session('errors.nombres') ? 'is-invalid' : '' ?>" value="<?= old('nombres') ?>" name="nombres" id="nombres" placeholder="Nombres del Usuario" required>
                    <p class="invalid-feedback"><?= session('errors.nombres') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombre_corto" class="form-label">Nombre Corto:</label>
                    <input type="text" class="form-control <?= session('errors.nombre_corto') ? 'is-invalid' : '' ?>" value="<?= old('nombre_corto') ?>" name="nombre_corto" id="nombre_corto" placeholder="Nombre Corto del Usuario" required>
                    <p class="invalid-feedback"><?= session('errors.nombre_corto') ?></p>
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" class="form-control <?= session('errors.usuario') ? 'is-invalid' : '' ?>" value="<?= old('usuario') ?>" name="usuario" id="usuario" placeholder="Nombre de Usuario" required>
                    <p class="invalid-feedback"><?= session('errors.usuario') ?></p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="text" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" value="<?= old('password') ?>" name="password" id="password" placeholder="Clave del Usuario" required>
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
                    <label for="id_perfil" class="form-label">Perfil:</label>
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
                        <label for="us_avatar" class="form-label">Avatar</label>
                        <div id="img_div" style="display: none;">
                            <img id="us_avatar" name="us_avatar" class="img-thumbnail" width="75">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="us_foto" class="form-label"></label>
                        <input type="file" name="us_foto" id="us_foto">
                        <p class="invalid-feedback"><?= session('errors.us_foto') ?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>