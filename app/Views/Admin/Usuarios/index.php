<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Usuarios
<?= $this->endSection('title') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Administración de Usuarios
        </div>
        <div class="card-body">
            <?php if (session('msg')) : ?>
                <div class="alert alert-<?= session('msg.type') ?> alert-dismissible fade show" role="alert">
                    <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <a href="<?= base_url(route_to('usuarios_create')) ?>" class="btn btn-block btn-primary btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Nuevo Usuario
            </a>
            <hr>
            <div class="row">
                <div class="col-md-12 table-responsive viewdata">
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('scripts') ?>
<script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
<script>
    let table;
    let tableInitialized = false;

    $(document).ready(function() {
        dataUsuarios();

        //Autoclose
        window.setTimeout(function() {
            $(".alert").fadeOut(1500, 0);
        }, 3000); //3 segundos y desaparece
    });

    function dataUsuarios() {
        $.ajax({
            url: "<?= base_url(route_to('usuarios_data')) ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);

                if (tableInitialized) {
                    table.destroy();
                }

                table = new DataTable('#tbl_usuarios', {
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 5, 6, 7]
                    }],
                    destroy: true,
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

                tableInitialized = true;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection('scripts') ?>