<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Asociar Asignaturas con Cursos
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">

    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Asociar Asignaturas con Cursos
        </div>
        <div class="card-body">
            <form id="form_insert" action="<?= base_url(route_to('asignaturas_cursos_store')) ?>" method="post">
                <div class="mb-2 row">
                    <label for="id_curso" class="col-2 control-label">Curso:</label>
                    <div class="col-10">
                        <select class="form-select" name="id_curso" id="id_curso">
                            <option value="">Seleccione...</option>
                            <?php foreach ($cursos as $v) : ?>
                                <option value="<?= $v->id_curso; ?>" <?= old('id_curso') == $v->id_curso ? 'selected' : '' ?>><?= "[" . $v->es_figura . "] - " . $v->cu_nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="invalid-feedback error-id-curso"></p>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="id_asignatura" class="col-2 control-label">Asignatura:</label>
                    <div class="col-10">
                        <select class="form-select" name="id_asignatura" id="id_asignatura">
                            <option value="">Seleccione...</option>
                            <?php foreach ($asignaturas as $v) : ?>
                                <option value="<?= $v->id_asignatura; ?>" <?= old('id_asignatura') == $v->id_asignatura ? 'selected' : '' ?>><?= "[" . $v->ar_nombre . "] - " . $v->as_nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="invalid-feedback error-id-asignatura"></p>
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-12 d-grid gap-2">
                        <button id="btn-add-item" type="submit" class="btn btn-primary btnAgregar">
                            <i class="fa fa-download"></i> Asociar
                        </button>
                    </div>
                </div>
            </form>
            <!-- Línea de división -->
            <hr>
            <!-- message -->
            <div id="text_message" class="text-center"></div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Curso</th>
                            <th>Asignatura</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_items">
                        <!-- Aqui desplegamos el contenido de la base de datos -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-10 text-end">
                    <label class="control-label" style="position:relative; top:7px;">Total Asignaturas:</label>
                </div>
                <div class="col-2" style="margin-top: 2px;">
                    <input type="text" class="form-control" id="total_asignaturas" value="0" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#id_curso').select2();
        $('#id_asignatura').select2();

        $("#lista_items").html("<tr><td colspan='4' align='center'>Debe seleccionar un curso...</td></tr>");

        toastr.options = {
            //primeras opciones
            "closeButton": false, //boton cerrar
            "debug": false,
            "newestOnTop": false, //notificaciones mas nuevas van en la parte superior
            "progressBar": true, //barra de progreso hasta que se oculta la notificacion
            "preventDuplicates": false, //para prevenir mensajes duplicados

            "onclick": null,

            //Posición de la notificación
            //toast-bottom-left, toast-bottom-right, toast-bottom-left, toast-top-full-width, toast-top-center
            "positionClass": "toast-top-center",

            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        };

        $("#id_curso").change(function() {
            var id_curso = $(this).val();
            if (id_curso == "")
                $("#lista_items").html("<tr><td colspan='4' align='center'>Debe seleccionar un curso...</td></tr>");
            else
                listarAsignaturasAsociadas(id_curso);
        });

        $("#form_insert").submit(function(e) {
            e.preventDefault();

            const id_curso = $("#id_curso").val();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnAgregar').attr('disable', 'disable');
                    $('.btnAgregar').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnAgregar').removeAttr('disable');
                    $('.btnAgregar').html('<i class="fa fa-download"></i> Asociar');
                },
                success: function(response) {
                    // alert(JSON.stringify(response))
                    if (response.errors) {
                        if (response.errors.id_curso) {
                            $('#id_curso').addClass('is-invalid');
                            $('.error-id-curso').html(response.errors.id_curso);
                        } else {
                            $('#id_curso').removeClass('is-invalid');
                            $('.error-id-curso').html('');
                        }

                        if (response.errors.id_asignatura) {
                            $('#id_asignatura').addClass('is-invalid');
                            $('.error-id-asignatura').html(response.errors.id_asignatura);
                        } else {
                            $('#id_asignatura').removeClass('is-invalid');
                            $('.error-id-asignatura').html('');
                        }
                    } else if (response.error) {
                        $('#id_curso').removeClass('is-invalid');
                        $('.error-id-curso').html('');

                        $('#id_asignatura').removeClass('is-invalid');
                        $('.error-id-asignatura').html('');

                        Swal.fire({
                            title: "Oops!",
                            text: response.error,
                            icon: "error"
                        });
                    } else {
                        $('#id_curso').removeClass('is-invalid');
                        $('.error-id-curso').html('');

                        $('#id_asignatura').removeClass('is-invalid');
                        $('.error-id-asignatura').html('');

                        /* Swal.fire({
                            title: "Logrado!",
                            text: response.success,
                            icon: "success"
                        }); */

                        toastr["success"](response.success, "Logrado!");

                        listarAsignaturasAsociadas(id_curso);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('#lista_items').on('click', '.item-delete', function(e) {
            e.preventDefault();

            let id = $(this).attr('data');
            let id_curso = document.getElementById("id_curso").value;

            $("#text_message").html("<img src='<?php echo base_url(); ?>Assets/img/ajax-loader-blue.GIF' alt='procesando...' />");

            $.ajax({
                url: "<?= base_url(route_to('asignaturas_cursos_delete')) ?>",
                method: "post",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $("#text_message").html("");

                    toastr[response.icon](response.message, response.title);

                    listarAsignaturasAsociadas(id_curso);
                },
                error: function(jqXHR, textStatus) {
                    alert(jqXHR.responseText);
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

    function listarAsignaturasAsociadas(id_curso) {
        $('#id_curso').removeClass('is-invalid');
        $('.error-id-curso').html('');

        $('#id_asignatura').removeClass('is-invalid');
        $('.error-id-asignatura').html('');

        var request = $.ajax({
            url: "<?= base_url(route_to('asignaturas_cursos_data')) ?>",
            method: "post",
            data: {
                id_curso: id_curso
            },
            dataType: "json"
        });

        request.done(function(data) {
            var html = '';
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    html += '<tr data-index="' + data[i].id_asignatura_curso + '" data-orden="' + data[i].ac_orden + '">' +
                        '<td>' + data[i].id_asignatura_curso + '</td>' +
                        '<td>' + data[i].es_figura + " - " + data[i].cu_nombre + '</td>' +
                        '<td>' + data[i].as_nombre + '</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<a href="javascript:;" class="btn btn-danger btn-sm item-delete" data="' + data[i].id_asignatura_curso +
                        '" title="Eliminar"><span class="fa fa-trash"></span></a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                }
                $("#lista_items").html(html);
                $("#total_asignaturas").val(data.length);
            } else {
                $("#lista_items").html("<tr><td colspan='4' align='center'>No se han asociado asignaturas a este curso...</td></tr>");
                $("#total_asignaturas").val(0);
            }
        });

        request.fail(function(jqXHR, textStatus) {
            alert("Requerimiento fallido: " + jqXHR.responseText);
        });
    }

    function saveNewPositions() {
        var positions = [];
        $('.updated').each(function() {
            positions.push([$(this).attr('data-index'), $(this).attr('data-orden')]);
            $(this).removeClass('updated');
        });

        id_curso = $("#id_curso").val();
        $.ajax({
            url: "<?= base_url(route_to('asignaturas_cursos_saveNewPositions')); ?>",
            method: 'POST',
            dataType: 'text',
            data: {
                positions: positions
            },
            success: function(response) {
                listarAsignaturasAsociadas(id_curso);
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>