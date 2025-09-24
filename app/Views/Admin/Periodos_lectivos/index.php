<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Periodos Lectivos
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Administración de Periodos Lectivos
        </div>
        <div class="card-body">
            <?php if (session('msg')) : ?>
                <div class="alert alert-<?= session('msg.type') ?> alert-dismissible fade show" role="alert">
                    <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <a href="<?= base_url(route_to('periodos_lectivos_create')) ?>" class="btn btn-block btn-danger btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Crear Periodo Lectivo
            </a>
            <hr>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table id="tbl_periodo_lectivo" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Modalidad</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_periodos_lectivos">
                            <?php
                            $contador = 0;
                            foreach ($periodos_lectivos as $v) {
                                $contador++;
                            ?>
                                <tr>
                                    <td><?= $contador; ?></td>
                                    <td><?= $v->id_periodo_lectivo; ?></td>
                                    <td><?= $v->mo_nombre; ?></td>
                                    <td><?php $fecha = date_create($v->pe_fecha_inicio);
                                        echo date_format($fecha, "d/M/Y") ?></td>
                                    <td><?php $fecha = date_create($v->pe_fecha_fin);
                                        echo date_format($fecha, "d/M/Y"); ?></td>
                                    <td><?= $v->pe_descripcion; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url(route_to('periodos_lectivos_edit', $v->id_periodo_lectivo)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#tbl_periodo_lectivo', {
        pageLength: 5,
        lengthMenu: [5, 10, 15, {
            label: 'Todos',
            value: -1
        }],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla =(",
            "sInfo": "Registros del _START_ al _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Registros del 0 al 0 de 0 registros",
            "sInfoFiltered": "-",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
</script>
<?= $this->endsection('scripts') ?>