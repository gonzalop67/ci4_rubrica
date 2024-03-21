<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Editar Una Asignatura
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<style>
    #nombre, #abreviatura, #nombre_corto {
        text-transform: uppercase;
    }
</style>
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Editar una Asignatura</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Editar Asignatura
        </div>

        <div class="card-body">
            <form action="<?= base_url(route_to('asignaturas_update')) ?>" method="post">
                <input type="hidden" name="id_asignatura" value="<?= $asignatura->id_asignatura ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?? $asignatura->as_nombre ?>" name="nombre" id="nombre" autofocus>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <div class="mb-3">
                    <label for="abreviatura" class="form-label">Abreviatura:</label>
                    <input type="text" class="form-control <?= session('errors.abreviatura') ? 'is-invalid' : '' ?>" value="<?= old('abreviatura') ?? $asignatura->as_abreviatura ?>" name="abreviatura" id="abreviatura">
                    <p class="invalid-feedback"><?= session('errors.abreviatura') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombre_corto" class="form-label">Nombre Corto:</label>
                    <input type="text" class="form-control <?= session('errors.nombre_corto') ? 'is-invalid' : '' ?>" value="<?= old('nombre_corto') ?? $asignatura->as_shortname ?>" name="nombre_corto" id="nombre_corto">
                    <p class="invalid-feedback"><?= session('errors.nombre_corto') ?></p>
                </div>
                <div class="mb-3">
                    <label for="id_area" class="form-label">Area:</label>
                    <select class="form-select" id="id_area" name="id_area">
                        <?php
                        foreach ($areas as $area) :
                        ?>
                            <option value="<?= $area->id_area ?>" <?= $asignatura->id_area == $area->id_area ? 'selected' : '' ?>><?= $area->ar_nombre ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.id_area') ?></p>
                </div>
                <div class="mb-3">
                    <label for="id_tipo_asignatura" class="form-label">Tipo de Asignatura:</label>
                    <select class="form-select" id="id_tipo_asignatura" name="id_tipo_asignatura">
                        <?php
                        foreach ($tipos_asignaturas as $tipo_asignatura) :
                        ?>
                            <option value="<?= $tipo_asignatura->id_tipo_asignatura ?>" <?= $asignatura->id_tipo_asignatura == $tipo_asignatura->id_tipo_asignatura ? 'selected' : '' ?>><?= $tipo_asignatura->ta_descripcion ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.id_tipo_asignatura') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('asignaturas')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>