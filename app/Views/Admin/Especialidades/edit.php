<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Edit Una Especialidad
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">editar una Especialidad</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Editar Especialidad
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('especialidades_update')) ?>" method="post">
                <input type="hidden" name="id_especialidad" value="<?= $especialidad->id_especialidad ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?? $especialidad->es_nombre ?>" name="nombre" id="nombre" autofocus>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <div class="mb-3">
                    <label for="figura" class="form-label">Figura:</label>
                    <input type="text" class="form-control <?= session('errors.figura') ? 'is-invalid' : '' ?>" value="<?= old('figura') ?? $especialidad->es_figura ?>" name="figura" id="figura">
                    <p class="invalid-feedback"><?= session('errors.figura') ?></p>
                </div>
                <div class="mb-3">
                    <label for="abreviatura" class="form-label">Abreviatura:</label>
                    <input type="text" class="form-control <?= session('errors.abreviatura') ? 'is-invalid' : '' ?>" value="<?= old('abreviatura') ?? $especialidad->es_abreviatura ?>" name="abreviatura" id="abreviatura">
                    <p class="invalid-feedback"><?= session('errors.abreviatura') ?></p>
                </div>
                <div class="mb-3">
                    <label for="id_nivel_educacion" class="form-label">Nivel Educación:</label>
                    <select class="form-select" id="id_nivel_educacion" name="id_nivel_educacion">
                        <?php
                        foreach ($niveles_educacion as $nivel) :
                        ?>
                            <option value="<?= $nivel->id_nivel_educacion ?>" <?= $especialidad->id_nivel_educacion == $nivel->id_nivel_educacion ? 'selected' : '' ?>><?= $nivel->nombre ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.id_nivel_educacion') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('especialidades')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>