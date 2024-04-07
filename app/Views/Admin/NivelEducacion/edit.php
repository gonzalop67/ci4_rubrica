<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Editar Un Nivel de Educacioón
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Editar un Nivel de Educación</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Editar Nivel de Educación
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('niveles_educacion_update')) ?>" method="post">
                <input type="hidden" name="id_nivel_educacion" value="<?= $nivel_educacion->id_nivel_educacion ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?? $nivel_educacion->nombre ?>" name="nombre" id="nombre" autofocus required>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <div class="mb-3">
                    <label for="es_bachillerato" class="form-label">¿Es Bachillerato?:</label>
                    <select class="form-select" id="es_bachillerato" name="es_bachillerato">
                        <option value="1" <?php if ($nivel_educacion->es_bachillerato == 1) echo "selected" ?>>Sí</option>
                        <option value="0" <?php if ($nivel_educacion->es_bachillerato == 0) echo "selected" ?>>No</option>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.es_bachillerato') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('niveles_educacion')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>