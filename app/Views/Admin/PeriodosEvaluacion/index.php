<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Periodos de Evaluacion
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <!-- <h2 class="mt-4">Modalidades</h2> -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Administración de Periodos de Evaluación</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listado
        </div>
        <div class="card-body">
            <?php if (session('msg')) : ?>
                <div class="alert alert-<?= session('msg.type') ?> alert-dismissible fade show" role="alert">
                    <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <a href="<?= base_url(route_to('periodos_evaluacion_create')) ?>" class="btn btn-block btn-primary btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Nuevo Registro
            </a>
            <hr>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Ponderación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="viewdata">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        dataPeriodosEvaluacion();

        //Autoclose
        window.setTimeout(function() {
            $(".alert").fadeOut(1500, 0);
        }, 3000); //3 segundos y desaparece

        $('table tbody').sortable({
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-orden') != (index + 1)) {
                        $(this).attr('data-orden', (index + 1)).addClass('updated');
                    }
                });

                saveNewPositions();
            }
        });
    });

    function dataPeriodosEvaluacion() {
        $.ajax({
            url: "<?= base_url(route_to('periodos_evaluacion_data')) ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function saveNewPositions() {
        var positions = [];
        $('.updated').each(function() {
            positions.push([$(this).attr('data-index'), $(this).attr('data-orden')]);
            $(this).removeClass('updated');
        });

        $.ajax({
            url: "<?= base_url(route_to('periodos_evaluacion_saveNewPositions')); ?>",
            method: 'POST',
            dataType: 'text',
            data: {
                positions: positions
            },
            success: function(response) {
                dataPeriodosEvaluacion();
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>