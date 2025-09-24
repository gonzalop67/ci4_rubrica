<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Niveles de Educación
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Administración de Niveles de Educación</li>
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
            <a href="<?= base_url(route_to('niveles_educacion_create')) ?>" class="btn btn-block btn-primary btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Nuevo Registro
            </a>
            <hr>
            <table id="tbl_nivel_educacion" class="table table-hover table-striped">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>¿Es Bachillerato?</th>
                    <th>Acciones</th>
                </thead>
                <tbody class="viewdata">

                </tbody>
            </table>
        </div>

    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        dataNivelesEducacion();

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

    function dataNivelesEducacion() {
        $.ajax({
            url: "<?= base_url(route_to('niveles_educacion_data')) ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function eliminar(id) {
        Swal.fire({
            title: "Eliminar",
            text: "¿Está seguro de eliminar este registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, elimínelo!",
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(route_to('niveles_educacion_delete')) ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            Swal.fire({
                                icon: response.icon,
                                title: "Eliminar",
                                text: response.message,
                            });
                            
                            dataNivelesEducacion();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
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
            url: "<?= base_url(route_to('niveles_educacion_saveNewPositions')); ?>",
            method: 'POST',
            dataType: 'text',
            data: {
                positions: positions
            },
            success: function(response) {
                // window.location.href = "<?= base_url(route_to('niveles_educacion'));; ?>";
                dataNivelesEducacion();
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>