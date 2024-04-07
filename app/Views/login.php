<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Iniciar Sesión</title>
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
                                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingrese usuario">
                                            <label for="usuario"><i class="fas fa-user"></i> Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="clave" name="clave" type="password" placeholder="Ingrese contraseña" />
                                            <label for="clave"><i class="fas fa-key"></i> Contraseña</label>
                                        </div>

                                        <?php if (session('msg')) : ?>
                                            <div class="alert alert-<?= session('msg.type') ?> alert-dismissible">
                                                <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                                            </div>
                                        <?php endif ?>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
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
    <script src="<?php echo base_url(); ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        const base_url = "<?php echo base_url(); ?>";
        console.log(base_url);

        function frmLogin(e) {
            e.preventDefault();
            const usuario = document.getElementById("usuario");
            const clave = document.getElementById("clave");
            if (usuario.value == "") {
                clave.classList.remove("is-invalid");
                usuario.classList.add("is-invalid");
                usuario.focus();
            } else if (clave.value == "") {
                usuario.classList.remove("is-invalid");
                clave.classList.add("is-invalid");
                clave.focus();
            } else {
                const frm = document.getElementById("frmLogin");
                frm.submit();
            }
        }
    </script>
</body>

</html>