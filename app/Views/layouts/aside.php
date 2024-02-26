        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- <div class="sb-sidenav-menu-heading">INICIO</div> -->
                        <a class="nav-link <?= service('request')->uri->getRoutePath() == 'auth/dashboard' ? 'active' : '' ?>" href="<?= base_url() . route_to('dashboard') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading"><?= session('nomPerfil') ?></div>

                        <?php

                        use App\Models\Admin\MenusModel;

                        $model = new MenusModel();
                        $menusNivel1 = $model->listarMenusNivel1(session("id_perfil"));
                        foreach ($menusNivel1 as $menu) {
                        ?>
                            <?php if (count($model->listarMenusHijos($menu->id_menu)) > 0) { ?>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#<?= $menu->mnu_texto ?>" aria-expanded="false" aria-controls="<?= $menu->mnu_texto ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                                    <?= $menu->mnu_texto ?>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="<?= $menu->mnu_texto ?>" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php foreach ($model->listarMenusHijos($menu->id_menu) as $menu2) { ?>
                                            <a class="nav-link <?= service('request')->uri->getRoutePath() == $menu2->mnu_link ? 'active' : '' ?>" href="<?php echo base_url() . $menu2->mnu_link; ?>"><?= $menu2->mnu_texto ?></a>
                                        <?php } ?>
                                        <!-- <a class="nav-link" href="#!">Supletorios</a> -->
                                    </nav>
                                </div>
                            <?php } else { ?>
                                <a class="nav-link <?= service('request')->uri->getRoutePath() == $menu->mnu_link ? 'active' : '' ?>" href="<?php echo base_url() . $menu->mnu_link; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                                    <?= $menu->mnu_texto ?>
                                </a>
                            <?php } ?>
                        <?php
                        }
                        ?>

                        <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Calificaciones
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#!">Parciales</a>
                                <a class="nav-link" href="#!">Supletorios</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Charts
                        </a> -->

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">
                        <?= session('nomPerfil') ?>
                        <br>
                        <?= session('modalidad') ?>
                    </div>
                </div>
            </nav>
        </div>