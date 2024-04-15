<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Escalas de Calificaciones
<?= $this->endsection('title') ?>
    
<?= $this->section('content') ?>
<div class="container-fluid px-4">

    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Administración de Escalas de Calificaciones
        </div>

        <div class="card-body">
            <button id="btn_nueva_escala" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nuevaEscalaModal"><i class="fa fa-plus-circle"></i> Nuevo Registro</button>
            <hr>

            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cualitativa</th>
                                <th>Cuantitativa</th>
                                <th>Nota Mínima</th>
                                <th>Nota Máxima</th>
                                <th>Equivalencia</th>
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

<div class="viewmodal" style="display: none;"></div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // JQuery Listo para utilizar
        listarEscalasCalificaciones();

        $('#btn_nueva_escala').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url(route_to('escalas_calificaciones_form_crear')) ?>",
                dataType: "json",
                success: function(response) {
                    // alert(response.data);
                    $('.viewmodal').html(response.data).show();
                    $('#nuevaEscalaModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

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

    function listarEscalasCalificaciones() {
        $.ajax({
                type: "post",
                url: "<?= base_url(route_to('escalas_calificaciones_data')) ?>",
                dataType: "json",
                success: function(response) {
                    // console.log(JSON.stringify(response))
                    $('.viewdata').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
    }

    function edit(e, obj, id_escala_calificaciones) {
        e.preventDefault();

        const url = $(obj).attr("href");

        $.ajax({
            type: "post",
            url: url,
            data: {
                id_escala_calificaciones: id_escala_calificaciones
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewmodal').html(response.success).show();
                    $('#editarEscalaModal').modal('show');
                }
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
            url: "<?= base_url(route_to('escalas_calificaciones_saveNewPositions')); ?>",
            method: 'POST',
            dataType: 'text',
            data: {
                positions: positions
            },
            success: function(response) {
                listarEscalasCalificaciones();
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>