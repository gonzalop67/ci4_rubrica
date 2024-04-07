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

                    $meses_abrev = array(0, "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
                    ?>
                    <select id="cboPeriodosL" name="cboPeriodosL" class="form-select">
                        <option value="">Seleccione...</option>
                        <?php foreach ($modalidades as $modalidad) : ?>
                            <optgroup label="<?= $modalidad->mo_nombre; ?>">
                            <?php $periodos_lectivos = $periodoLectivoModel->listarPeriodosPorModalidad($modalidad->id_modalidad); ?>
                                <?php foreach ($periodos_lectivos as $periodo_lectivo) : ?>
                                   <?php 
                                   $fecha_inicial = explode("-", $periodo_lectivo->pe_fecha_inicio);
                                   $fecha_final = explode("-", $periodo_lectivo->pe_fecha_fin);

                                   $nombrePeriodoLectivo = $meses_abrev[(int)$fecha_inicial[1]] . " " . $fecha_inicial[0] . " - " . $meses_abrev[(int)$fecha_final[1]] . " " . $fecha_final[0] . " [" . $periodo_lectivo->pe_descripcion . "]";
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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gonzalo <i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url() . route_to('signout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>