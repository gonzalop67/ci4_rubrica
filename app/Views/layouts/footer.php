            <?php
            use App\Models\Admin\InstitucionModel;
            $institucionModel = new InstitucionModel();
            $Institucion = $institucionModel
                                ->where('id_institucion', 1)
                                ->first();
            $nomInstitucion = $Institucion->in_nombre;
            $urlInstitucion = $Institucion->in_url;
            ?>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">
                            Copyright &copy; <a href="<?= $urlInstitucion; ?>" target="_blank"><?= $nomInstitucion; ?></a> <?= date('Y'); ?>
                        </div>
                    </div>
                </div>
            </footer>