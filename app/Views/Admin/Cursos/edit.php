<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Editar Un Curso
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Editar un Curso</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Editar Curso
        </div>

        <div class="card-body">
            <form action="<?= base_url(route_to('cursos_update')) ?>" method="post">
                <input type="hidden" name="id_curso" value="<?= $curso->id_curso ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?? $curso->cu_nombre ?>" name="nombre" id="nombre" autofocus>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <div class="mb-3">
                    <label for="abreviatura" class="form-label">Abreviatura:</label>
                    <input type="text" class="form-control <?= session('errors.abreviatura') ? 'is-invalid' : '' ?>" value="<?= old('abreviatura') ?? $curso->cu_abreviatura ?>" name="abreviatura" id="abreviatura">
                    <p class="invalid-feedback"><?= session('errors.abreviatura') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombre_corto" class="form-label">Nombre Corto:</label>
                    <input type="text" class="form-control <?= session('errors.nombre_corto') ? 'is-invalid' : '' ?>" value="<?= old('nombre_corto') ?? $curso->cu_shortname ?>" name="nombre_corto" id="nombre_corto">
                    <p class="invalid-feedback"><?= session('errors.nombre_corto') ?></p>
                </div>
                <div class="mb-3">
                    <label for="es_bach_tecnico" class="form-label">¿Bachillerato Técnico?</label>
                    <select class="form-select <?= session('errors.es_bach_tecnico') ? 'is-invalid' : '' ?>" id="es_bach_tecnico" name="es_bach_tecnico">
                        <option value="0" <?= $curso->es_bach_tecnico == 0 ? 'selected' : '' ?>>No</option>
                        <option value="1" <?= $curso->es_bach_tecnico == 1 ? 'selected' : '' ?>>Sí</option>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.es_bach_tecnico') ?></p>
                </div>
                <div class="mb-3">
                    <label for="es_intensivo" class="form-label">¿Es Intensivo?</label>
                    <select class="form-select <?= session('errors.es_intensivo') ? 'is-invalid' : '' ?>" id="es_intensivo" name="es_intensivo">
                        <option value="0" <?= $curso->es_intensivo == 0 ? 'selected' : '' ?>>No</option>
                        <option value="1" <?= $curso->es_intensivo == 1 ? 'selected' : '' ?>>Sí</option>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.es_intensivo') ?></p>
                </div>
                <div class="mb-3">
                    <label for="id_especialidad" class="form-label">Especialidad:</label>
                    <select class="form-select" id="id_especialidad" name="id_especialidad">
                        <?php
                        foreach ($especialidades as $especialidad) :
                        ?>
                            <option value="<?= $especialidad->id_especialidad ?>" <?= $curso->id_especialidad == $especialidad->id_especialidad ? 'selected' : '' ?>><?= $especialidad->es_figura ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.id_especialidad') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('cursos')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>