        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">SIAE <?= session('periodo') ?></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <?php

                    use App\Models\Admin\ModalidadesModel;
                    use App\Models\Admin\PeriodosLectivosModel;

                    $modalidadModel = new ModalidadesModel();
                    $modalidades = $modalidadModel->listarModalidades();

                    $periodoLectivoModel = new PeriodosLectivosModel();
                    ?>
                    <select id="cboPeriodosL" name="cboPeriodosL" class="form-select">
                        <option value="">Seleccione...</option>
                        <?php foreach ($modalidades as $modalidad) : ?>
                            <optgroup label="<?= $modalidad->mo_nombre; ?>">
                                <?php $periodos_lectivos = $periodoLectivoModel->listarPeriodosPorModalidad($modalidad->id_modalidad); ?>
                                <?php foreach ($periodos_lectivos as $periodo_lectivo) : ?>
                                    <?php
                                    $nombrePeriodoLectivo = fecha_corta($periodo_lectivo->pe_fecha_inicio) . " - " . fecha_corta($periodo_lectivo->pe_fecha_fin) . " [" . $periodo_lectivo->pe_descripcion . "]";
                                    ?>

                                    <option value="<?= $periodo_lectivo->id_periodo_lectivo ?>"><?= $nombrePeriodoLectivo; ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        <?php endforeach ?>
                    </select>
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= session('nomUsuario') ?> <i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url() . route_to('signout') ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>