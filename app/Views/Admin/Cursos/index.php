<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Cursos
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Administración de Cursos</li>
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
            <a href="<?= base_url(route_to('cursos_create')) ?>" class="btn btn-block btn-primary btn-sm">
                <i class="fa fa-fw fa-plus-circle"></i> Nuevo Curso
            </a>
            <hr>
            <table id="tbl_cursos" class="table table-hover table-striped">
                <thead>
                    <th>Id</th>
                    <th>Especialidad</th>
                    <th>Figura</th>
                    <th>Nombre</th>
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
        dataCursos();

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

    function dataCursos() {
        $.ajax({
            url: "<?= base_url(route_to('cursos_data')) ?>",
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
                    url: "<?= base_url(route_to('cursos_delete')) ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: response.icon,
                                title: "Eliminar",
                                text: response.message,
                            });
                            
                            dataCursos();
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
            url: "<?= base_url(route_to('cursos_saveNewPositions')); ?>",
            method: 'POST',
            dataType: 'text',
            data: {
                positions: positions
            },
            success: function(response) {
                dataCursos();
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>