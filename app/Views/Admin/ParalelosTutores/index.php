<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Asociar Paralelos con Tutores
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">

    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Asociar Paralelos con Tutores
        </div>
        <div class="card-body">
            <form id="form_insert" action="<?= base_url(route_to('paralelos_tutores_store')) ?>" method="post">
                <div class="mb-2 row">
                    <label for="id_paralelo" class="col-2 control-label">Paralelo:</label>
                    <div class="col-10">
                        <select class="form-select" name="id_paralelo" id="id_paralelo">
                            <option value="">Seleccione...</option>
                            <?php foreach ($paralelos as $v) : ?>
                                <option value="<?= $v->id_paralelo; ?>" <?= old('id_paralelo') == $v->id_paralelo ? 'selected' : '' ?>><?= $v->cu_nombre . " " . $v->pa_nombre . " - " . $v->es_figura . " - " . $v->jo_nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="invalid-feedback error-id-paralelo"></p>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="id_usuario" class="col-2 control-label">Docente:</label>
                    <div class="col-10">
                        <select class="form-select" name="id_usuario" id="id_usuario">
                            <option value="">Seleccione...</option>
                            <?php foreach ($usuarios as $v) : ?>
                                <option value="<?= $v->id_usuario; ?>" <?= old('id_usuario') == $v->id_usuario ? 'selected' : '' ?>><?= $v->us_titulo . " " . $v->us_apellidos . " " . $v->us_nombres; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="invalid-feedback error-id-usuario"></p>
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
                            <th>Paralelo</th>
                            <th>Tutor</th>
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
                    <label class="control-label" style="position:relative; top:7px;">Total Tutores:</label>
                </div>
                <div class="col-2" style="margin-top: 2px;">
                    <input type="text" class="form-control text-end" id="total_tutores" value="0" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#id_paralelo').select2();
        $('#id_usuario').select2();

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

        listarTutoresAsociados();

        $("#form_insert").submit(function(e) {
            e.preventDefault();

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
                        if (response.errors.id_paralelo) {
                            $('#id_paralelo').addClass('is-invalid');
                            $('.error-id-paralelo').html(response.errors.id_paralelo);
                        } else {
                            $('#id_paralelo').removeClass('is-invalid');
                            $('.error-id-paralelo').html('');
                        }

                        if (response.errors.id_usuario) {
                            $('#id_usuario').addClass('is-invalid');
                            $('.error-id-usuario').html(response.errors.id_usuario);
                        } else {
                            $('#id_usuario').removeClass('is-invalid');
                            $('.error-id-usuario').html('');
                        }
                    } else if (response.error) {
                        $('#id_paralelo').removeClass('is-invalid');
                        $('.error-id-paralelo').html('');

                        $('#id_usuario').removeClass('is-invalid');
                        $('.error-id-usuario').html('');

                        Swal.fire({
                            title: "Oops!",
                            text: response.error,
                            icon: "error"
                        });
                    } else {
                        $('#id_paralelo').removeClass('is-invalid');
                        $('.error-id-paralelo').html('');

                        $('#id_usuario').removeClass('is-invalid');
                        $('.error-id-usuario').html('');

                        toastr["success"](response.success, "Logrado!");

                        listarTutoresAsociados();
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

            $("#text_message").html("<img src='<?php echo base_url(); ?>Assets/img/ajax-loader-blue.GIF' alt='procesando...' />");

            $.ajax({
                url: "<?= base_url(route_to('paralelos_tutores_delete')) ?>",
                method: "post",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $("#text_message").html("");

                    toastr[response.icon](response.message, response.title);

                    listarTutoresAsociados();
                },
                error: function(jqXHR, textStatus) {
                    alert(jqXHR.responseText);
                }
            });
        });
    });

    function listarTutoresAsociados() {
        $('#id_paralelo').removeClass('is-invalid');
        $('.error-id-paralelo').html('');

        $('#id_usuario').removeClass('is-invalid');
        $('.error-id-usuario').html('');

        var request = $.ajax({
            url: "<?= base_url(route_to('paralelos_tutores_data')) ?>",
            method: "post",
            dataType: "json"
        });

        request.done(function(data) {
            var html = '';
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + data[i].id_paralelo_tutor + '</td>' +
                        '<td>' + data[i].cu_nombre + ' ' + data[i].pa_nombre + ' - [' + data[i].es_figura + ']</td>' +
                        '<td>' + data[i].us_titulo + ' ' + data[i].us_fullname + '</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<a href="javascript:;" class="btn btn-danger btn-sm item-delete" data="' + data[i].id_paralelo_tutor +
                        '" title="Eliminar"><span class="fa fa-trash"></span></a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                }
                $("#lista_items").html(html);
                $("#total_tutores").val(data.length);
            } else {
                $("#lista_items").html("<tr><td colspan='4' align='center'>No se han asociado tutores a este periodo lectivo...</td></tr>");
                $("#total_tutores").val(0);
            }
        });

        request.fail(function(jqXHR, textStatus) {
            alert("Requerimiento fallido: " + jqXHR.responseText);
        });
    }
</script>
<?= $this->endsection('scripts') ?>