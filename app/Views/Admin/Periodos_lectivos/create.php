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
                        <div class="form-group">
                            <label for="pe_anio_inicio">Año Inicial:</label>
                            <input type="number" name="pe_anio_inicio" id="pe_anio_inicio" value="<?= old('pe_anio_inicio') ?>" class="form-control <?= session('errors.pe_anio_inicio') ? 'is-invalid' : '' ?>" autofocus required>
                            <span class="invalid-feedback"><?= session('errors.pe_anio_inicio') ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pe_anio_fin">Año Final:</label>
                            <input type="number" name="pe_anio_fin" id="pe_anio_fin" value="<?= old('pe_anio_fin') ?>" class="form-control <?= session('errors.pe_anio_fin') ? 'is-invalid' : '' ?>" required>
                            <span class="invalid-feedback"><?= session('errors.pe_anio_fin') ?></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <div id="div_pe_fecha_inicio" class="form-group">
                            <label for="pe_fecha_inicio">Fecha de inicio:</label>
                            <div class="controls">
                                <div class="input-group date">
                                    <input type="date" name="pe_fecha_inicio" id="pe_fecha_inicio" class="form-control <?= session('errors.pe_fecha_inicio') ? 'is-invalid' : '' ?>" value="<?= old('pe_fecha_inicio') ?>" required>
                                    <span id="span_pe_fecha_inicio" class="invalid-feedback"><?= session('errors.pe_fecha_inicio') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="div_pe_fecha_fin" class="form-group">
                            <label for="pe_fecha_fin">Fecha de fin:</label>
                            <div class="controls">
                                <div class="input-group date">
                                    <input type="date" name="pe_fecha_fin" id="pe_fecha_fin" class="form-control <?= session('errors.pe_fecha_fin') ? 'is-invalid' : '' ?>" value="<?= old('pe_fecha_fin') ?>" required>
                                    <span id="span_pe_fecha_fin" class="invalid-feedback"><?= session('errors.pe_fecha_fin') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pe_nota_minima">Nota mínima:</label>
                            <input type="number" min="0.01" step="0.01" class="form-control fuente9 <?= session('errors.pe_nota_minima') ? 'is-invalid' : '' ?>" name="pe_nota_minima" id="pe_nota_minima" value="0.01" required>
                            <span id="span_pe_nota_minima" class="invalid-feedback"><?= session('errors.pe_nota_minima') ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pe_nota_aprobacion">Nota aprobación:</label>
                            <input name="pe_nota_aprobacion" type="number" min="7" max="10" step="0.01" class="form-control fuente9" id="pe_nota_aprobacion" value="7" required>
                            <span id="span_pe_nota_aprobacion" class="invalid-feedback"><?= session('errors.pe_nota_aprobacion') ?></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-12">
                        <div id="div_id_modalidad" class="form-group">
                            <label for="id_modalidad">Modalidad:</label>
                            <select name="id_modalidad" id="id_modalidad" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($modalidades as $v) : ?>
                                    <option value="<?= $v->id_modalidad ?>" <?= old('id_modalidad') == $v->id_modalidad ? 'selected' : '' ?>>
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