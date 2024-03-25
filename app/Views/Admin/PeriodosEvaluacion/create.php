<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Crear Un Periodo de Evaluación
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<style>
    #nombre, #abreviatura {
        text-transform: uppercase;
    }
</style>
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Crear un nuevo Periodo de Evaluación</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Nuevo Periodo de Evaluación
        </div>

        <div class="card-body">
            <form action="<?= base_url(route_to('periodos_evaluacion_store')) ?>" method="post">
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
                    <label for="ponderacion" class="form-label">Ponderación:</label>
                    <input type="number" min="0" max="1" step="0.01" class="form-control <?= session('errors.ponderacion') ? 'is-invalid' : '' ?>" value="<?= old('ponderacion') ?>" name="ponderacion" id="ponderacion">
                    <p class="invalid-feedback"><?= session('errors.ponderacion') ?></p>
                </div>
                <div class="mb-3">
                    <label for="id_tipo_periodo" class="form-label">Tipo de Periodo:</label>
                    <select class="form-select" id="id_tipo_periodo" name="id_tipo_periodo">
                        <?php
                        foreach ($tipos_periodos as $tipo_periodo) :
                        ?>
                            <option value="<?= $tipo_periodo->id_tipo_periodo ?>"><?= $tipo_periodo->tp_descripcion ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.id_tipo_periodo') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('periodos_evaluacion')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>