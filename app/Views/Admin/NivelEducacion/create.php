<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Crear Un Nivel de Educacioón
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Crear un nuevo Nivel de Educación</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Nuevo Nivel de Educación
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('niveles_educacion_store')) ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" name="nombre" id="nombre" autofocus required>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <div class="mb-3">
                    <label for="es_bachillerato" class="form-label">¿Es Bachillerato?:</label>
                    <select class="form-select" id="es_bachillerato" name="es_bachillerato">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
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