<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Iniciar Sesión</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>Assets/img/favicon.ico" />
    <link href="<?php echo base_url(); ?>Assets/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>Assets/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary" style="background: url('<?php echo base_url(); ?>Assets/img/loginFont.jpg')">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">S.I.A.E.</h3>
                                </div>
                                <div class="card-body">
                                    <form id="frmLogin" action="<?= base_url(route_to('signin')) ?>" method="POST" autocomplete="off">
                                        <?= csrf_field() ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingrese usuario" value="<?= old('usuario') ?>">
                                            <label for="usuario"><i class="fas fa-user"></i> Usuario</label>
                                            <p id="error-usuario" class="invalid-feedback"></p>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="clave" name="clave" type="password" placeholder="Ingrese contraseña" value="<?= old('clave') ?>">
                                            <label for="clave"><i class="fas fa-key"></i> Contraseña</label>
                                            <p id="error-clave" class="invalid-feedback"></p>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <?php

                                            use App\Models\Admin\PeriodosLectivosModel;

                                            $periodoLectivoModel = new PeriodosLectivosModel();
                                            ?>
                                            <select class="form-select" name="periodo" id="periodo">
                                                <option value="">Seleccione...</option>
                                                <?php foreach ($modalidades as $modalidad) : ?>
                                                    <optgroup label="<?= $modalidad->mo_nombre; ?>">
                                                        <?php $periodos_lectivos = $periodoLectivoModel->listarPeriodosPorModalidad($modalidad->id_modalidad); ?>
                                                        <?php foreach ($periodos_lectivos as $periodo_lectivo) : ?>
                                                            <?php
                                                            $nombrePeriodoLectivo = fecha_corta($periodo_lectivo->pe_fecha_inicio) . " - " . fecha_corta($periodo_lectivo->pe_fecha_fin) . " [" . $periodo_lectivo->pe_descripcion . "]";
                                                            ?>

                                                            <option value="<?= $periodo_lectivo->id_periodo_lectivo ?>" <?= old('periodo') == $periodo_lectivo->id_periodo_lectivo ? 'selected' : '' ?>><?= $nombrePeriodoLectivo; ?></option>
                                                        <?php endforeach ?>
                                                    </optgroup>
                                                <?php endforeach ?>
                                            </select>
                                            <label for="periodo"><i class="fa-solid fa-calendar"></i> Periodo Lectivo</label>
                                            <p id="error-periodo" class="invalid-feedback"></p>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="perfil" id="perfil">
                                                <option value="">Seleccione...</option>
                                                <?php foreach ($perfiles as $perfil) : ?>
                                                    <option value="<?= $perfil->id_perfil ?>" <?= old('perfil') == $perfil->id_perfil ? 'selected' : '' ?>><?= $perfil->pe_nombre; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <label for="perfil"><i class="fa-solid fa-user-gear"></i></i> Perfil</label>
                                            <p id="error-perfil" class="invalid-feedback"></p>
                                        </div>

                                        <?php if (session('msg')) : ?>
                                            <div class="alert alert-<?= session('msg.type') ?> alert-dismissible">
                                                <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                                            </div>
                                        <?php endif ?>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <!-- ¿Olvidó su contraseña? -->
                                            <a class="small" href="password.html"></a>
                                            <button class="btn btn-primary" type="submit" onclick="frmLogin(event);"><i class="fas fa-sign-in"></i> Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer style="text-align: center; color: white; margin-top: -40px;">
                .: &copy; <?php echo date("  Y"); ?> - <?= $nombreInstitucion; ?> :.
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>Assets/js/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
    <!-- <script src="<?php echo base_url(); ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->

    <script>
        const base_url = "<?php echo base_url(); ?>";
        console.log(base_url);

        function frmLogin(e) {
            e.preventDefault();
            const usuario = document.getElementById("usuario");
            const clave = document.getElementById("clave");
            const periodo = document.getElementById("periodo");
            const perfil = document.getElementById("perfil");

            if (usuario.value == "" || clave.value == "" || periodo.value == "" || perfil.value == "") {

                if (usuario.value == "") {
                    usuario.classList.add("is-invalid");
                    document.getElementById("error-usuario").innerHTML = "El campo Usuario es obligatorio.";
                } else {
                    usuario.classList.remove("is-invalid");
                    document.getElementById("error-usuario").innerHTML = "";
                }

                if (clave.value == "") {
                    clave.classList.add("is-invalid");
                    document.getElementById("error-clave").innerHTML = "El campo Contraseña es obligatorio.";
                } else {
                    clave.classList.remove("is-invalid");
                    document.getElementById("error-clave").innerHTML = "";
                } 
                
                if (periodo.value == "") {
                    periodo.classList.add("is-invalid");
                    document.getElementById("error-periodo").innerHTML = "El campo Periodo Lectivo es obligatorio.";
                } else {
                    periodo.classList.remove("is-invalid");
                    document.getElementById("error-periodo").innerHTML = "";
                }

                if (perfil.value == "") {
                    perfil.classList.add("is-invalid");
                    document.getElementById("error-perfil").innerHTML = "El campo Perfil es obligatorio.";
                } else {
                    perfil.classList.remove("is-invalid");
                    document.getElementById("error-perfil").innerHTML = "";
                }

            } else {
                const frm = document.getElementById("frmLogin");
                frm.submit();
            }
        }
    </script>
</body>

</html>