<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Crear Un Periodo Lectivo
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <!-- <h2 class="mt-4">Modalidades</h2> -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Crear un nuevo Periodo Lectivo</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-graduation-cap me-1"></i>
            Nuevo Periodo Lectivo
        </div>
        <div class="card-body">
            <form action="<?= base_url(route_to('periodos_lectivos_store')) ?>" method="post">
                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <div class="form-group <?= session('errors.pe_anio_inicio') ? 'has-error' : '' ?>">
                            <label for="pe_anio_inicio">Año Inicial:</label>
                            <input type="text" name="pe_anio_inicio" id="pe_anio_inicio" value="<?= old('pe_anio_inicio') ?>" class="form-control" autofocus>
                            <span class="help-block"><?= session('errors.pe_anio_inicio') ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group <?= session('errors.pe_anio_fin') ? 'has-error' : '' ?>">
                            <label for="pe_anio_fin">Año Final:</label>
                            <input type="number" name="pe_anio_fin" id="pe_anio_fin" value="<?= old('pe_anio_fin') ?>" class="form-control" autofocus>
                            <span class="help-block"><?= session('errors.pe_anio_fin') ?></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <div id="div_pe_fecha_inicio" class="form-group">
                            <label for="pe_fecha_inicio">Fecha de inicio:</label>
                            <div class="controls">
                                <div class="input-group date">
                                    <input type="date" name="pe_fecha_inicio" id="pe_fecha_inicio" class="form-control">
                                    <label class="input-group-addon generic-btn" style="cursor: pointer;" onclick="$('#pe_fecha_inicio').focus();">
                                        <span id="span_pe_fecha_inicio" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="div_pe_fecha_fin" class="form-group">
                            <label for="pe_fecha_fin">Fecha de fin:</label>
                            <div class="controls">
                                <div class="input-group date">
                                    <input type="date" name="pe_fecha_fin" id="pe_fecha_fin" class="form-control">
                                    <label class="input-group-addon generic-btn" style="cursor: pointer;" onclick="$('#pe_fecha_fin').focus();">
                                        <span id="span_pe_fecha_fin" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="div_id_modalidad" class="form-group">
                            <label for="id_modalidad">Modalidad:</label>
                            <select name="id_modalidad" id="id_modalidad" class="form-control">
                                <option value="0">Seleccione...</option>
                                <?php foreach ($modalidades as $v) : ?>
                                    <option value="<?= $v->id_modalidad ?>">
                                        <?= $v->mo_nombre ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span id="span_id_modalidad" class="help-block"></span>
                        </div>
                    </div>
                </div>
                <p>
                    <div class="form-group">
                        <button id="btn-save" type="submit" class="btn btn-primary">Guardar</button>
                        <a href="<?= base_url(route_to('periodos_lectivos')) ?>" class="btn btn-secondary">Regresar</a>
                    </div>
                </p>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>