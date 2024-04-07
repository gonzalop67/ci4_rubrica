<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Editar Una Modalidad
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
    <!-- <h2 class="mt-4">Modalidades</h2> -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Editar una Modalidad</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Editar modalidad
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('modalidades_update')) ?>" method="post">
                <input type="hidden" name="id_modalidad" id="id_modalidad" value="<?= $modalidad->id_modalidad ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre:</label>
                    <input type="text" class="form-control" value="<?= old('nombre') ?? $modalidad->mo_nombre ?>" name="nombre" id="nombre" autofocus>
                    <p style="color: #e73d4a"><?= session('errors.nombre') ?></p>
                </div>
                <div class="mb-3">
                    <label for="activo" class="form-label fw-bold">Activo:</label>
                    <select class="form-select" id="activo" name="activo">
                        <option value="1" <?= old('mo_activo') ?? $modalidad->mo_activo == 1 ? 'selected' : '' ?>>Sí</option>
                        <option value="0" <?= old('mo_activo') ?? $modalidad->mo_activo == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                    <p style="color: #e73d4a"></p>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?= base_url(route_to('modalidades')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>