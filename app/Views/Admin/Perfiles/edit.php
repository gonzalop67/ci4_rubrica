<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Editar Un Perfil
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Editar un nuevo Perfil</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Editar perfil
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('perfiles_update')) ?>" method="post">
                <input type="hidden" name="id_perfil" id="id_perfil" value="<?= $perfil->id_perfil ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?? $perfil->pe_nombre ?>" name="nombre" id="nombre" autofocus required>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('perfiles')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>