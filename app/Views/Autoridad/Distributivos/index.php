<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Distributivos
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Distributivos
        </div>

        <div class="card-body">
            <form id="form_insert" action="<?= base_url(route_to('distributivos_store')) ?>" method="post">
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
                    <label for="id_asignatura" class="col-2 control-label">Asignatura:</label>
                    <div class="col-10">
                        <select class="form-select" name="id_asignatura" id="id_asignatura">
                            <option value="">Seleccione...</option>
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
                            <th>Paralelo</th>
                            <th>Asignatura</th>
                            <th>Presenciales</th>
                            <th>Autónomas</th>
                            <th>Tutorías</th>
                            <th>Sub Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="lista_items">
                        <!-- Aqui desplegamos el contenido de la base de datos -->
                    </tbody>
                </table>
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
        $('#id_asignatura').select2();

        $("#id_paralelo").change(function(e) {
            e.preventDefault();
            $("#text_message").html("");
            listarAsignaturasAsociadas($(this).val());
        })

        $("#id_usuario").change(function(e) {
            e.preventDefault();
            $("#text_message").html("");
            listarDistributivo();
        });

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
                        if (response.errors.id_usuario) {
                            $('#id_usuario').addClass('is-invalid');
                            $('.error-id-usuario').html(response.errors.id_usuario);
                        } else {
                            $('#id_usuario').removeClass('is-invalid');
                            $('.error-id-usuario').html('');
                        }

                        if (response.errors.id_paralelo) {
                            $('#id_paralelo').addClass('is-invalid');
                            $('.error-id-paralelo').html(response.errors.id_paralelo);
                        } else {
                            $('#id_paralelo').removeClass('is-invalid');
                            $('.error-id-paralelo').html('');
                        }

                        if (response.errors.id_asignatura) {
                            $('#id_asignatura').addClass('is-invalid');
                            $('.error-id-asignatura').html(response.errors.id_asignatura);
                        } else {
                            $('#id_asignatura').removeClass('is-invalid');
                            $('.error-id-asignatura').html('');
                        }
                    } else if (response.error) {
                        $('#id_usuario').removeClass('is-invalid');
                        $('.error-id-usuario').html('');

                        $('#id_paralelo').removeClass('is-invalid');
                        $('.error-id-paralelo').html('');

                        $('#id_asignatura').removeClass('is-invalid');
                        $('.error-id-asignatura').html('');

                        Swal.fire({
                            title: "Oops!",
                            text: response.error,
                            icon: "error"
                        });
                    } else {
                        $('#id_usuario').removeClass('is-invalid');
                        $('.error-id-usuario').html('');

                        $('#id_paralelo').removeClass('is-invalid');
                        $('.error-id-paralelo').html('');

                        $('#id_asignatura').removeClass('is-invalid');
                        $('.error-id-asignatura').html('');

                        toastr["success"](response.success, "Logrado!");

                        listarDistributivo();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $("#lista_items").html("<tr><td colspan='8' align='center'>Debe seleccionar un docente...</td></tr>");
    });

    function listarAsignaturasAsociadas(id_paralelo) {
        $.ajax({
            type: "post",
            url: "<?= base_url(route_to('listar_asignaturas_por_paralelo')) ?>",
            data: {
                id_paralelo: id_paralelo
            },
            dataType: "json",
            success: function(data) {
                var html = '';
                if (data.length > 0) {
                    document.getElementById("id_asignatura").length = 0;
                    $("#id_asignatura").append("<option value=''>Seleccione...</option>");
                    for (let i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id_asignatura + '">' + data[i].as_nombre + '</option>';
                    }
                    $("#id_asignatura").append(html);
                } else {
                    toastr["error"]("No se han definido asignaturas para el paralelo seleccionado", "Oops!");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function listarDistributivo() {
        //
    }
</script>
<?= $this->endsection('scripts') ?>