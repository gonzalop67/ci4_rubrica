<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Crear Un Curso
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Crear un nuevo Curso</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Nuevo Curso
        </div>

        <div class="card-body">
            <form action="<?= base_url(route_to('cursos_store')) ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" name="nombre" id="nombre" autofocus>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <div class="mb-3">
                    <label for="abreviatura" class="form-label">Abreviatura:</label>
                    <input type="text" class="form-control <?= session('errors.abreviatura') ? 'is-invalid' : '' ?>" value="<?= old('abreviatura') ?>" name="abreviatura" id="abreviatura">
                    <p class="invalid-feedback"><?= session('errors.abreviatura') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombre_corto" class="form-label">Nombre Corto:</label>
                    <input type="text" class="form-control <?= session('errors.nombre_corto') ? 'is-invalid' : '' ?>" value="<?= old('nombre_corto') ?>" name="nombre_corto" id="nombre_corto">
                    <p class="invalid-feedback"><?= session('errors.nombre_corto') ?></p>
                </div>
                <div class="mb-3">
                    <label for="quien_inserta_comp" class="form-label">Nivel Educación:</label>
                    <select class="form-select" id="id_nivel_educacion" name="id_nivel_educacion">
                        <?php
                        foreach ($niveles_educacion as $nivel) :
                        ?>
                            <option value="<?= $nivel->id_nivel_educacion ?>"><?= $nivel->nombre ?></option>
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