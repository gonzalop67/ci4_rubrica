<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Editar Un Perfil
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4 mt-2">
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
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="text" class="form-control <?= session('errors.slug') ? 'is-invalid' : '' ?>" value="<?= old('slug') ?? $perfil->pe_slug ?>" name="slug" id="slug" autofocus required>
                    <p class="invalid-feedback"><?= session('errors.slug') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('perfiles')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    const base_url = "<?php echo base_url(); ?>";
    console.log(base_url);
</script>
<?= $this->endsection('scripts') ?>
<script src="<?php echo base_url(); ?>Assets/js/pages/admin/perfiles/create.js"></script>