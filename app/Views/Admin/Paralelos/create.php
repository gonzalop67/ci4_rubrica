<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Crear Un Paralelo
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
        <li class="breadcrumb-item active">Crear un nuevo Paralelo</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Nuevo Paralelo
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('paralelos_store')) ?>" method="post">
                <div class="mb-3">
                    <label for="id_curso" class="form-label">Curso:</label>
                    <select class="form-select" id="id_curso" name="id_curso">
                        <?php
                        foreach ($cursos as $curso) :
                        ?>
                            <option value="<?= $curso->id_curso ?>"><?= $curso->es_figura . " - " . $curso->cu_nombre ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.id_curso') ?></p>
                </div>
                <div class="mb-3">
                    <label for="id_jornada" class="form-label">Jornada:</label>
                    <select class="form-select" id="id_jornada" name="id_jornada">
                        <?php
                        foreach ($jornadas as $jornada) :
                        ?>
                            <option value="<?= $jornada->id_jornada ?>"><?= $jornada->jo_nombre ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="invalid-feedback"><?= session('errors.id_jornada') ?></p>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control <?= session('errors.nombre') ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" name="nombre" id="nombre" autofocus>
                    <p class="invalid-feedback"><?= session('errors.nombre') ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= base_url(route_to('paralelos')) ?>" class="btn btn-secondary">Regresar</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>