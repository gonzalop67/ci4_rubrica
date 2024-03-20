<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Editar Un Area
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<style>
    #nombre {
        text-transform: uppercase;
    }
</style>
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Editar un Area</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Editar Area
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('areas_update')) ?>" method="post">
                <input type="hidden" name="id_area" value="<?= $area->id_area ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?? $area->ar_nombre ?>" name="nombre" id="nombre" autofocus required>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('areas')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>