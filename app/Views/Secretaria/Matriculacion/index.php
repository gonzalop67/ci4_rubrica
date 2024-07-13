<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Matriculación de Estudiantes
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<style>
    .fuente8 {
        font: 8pt helvetica;
    }

    .fuente9 {
        font: 9pt helvetica;
    }

    input {
        font: 9pt helvetica;
    }

    .mayusculas {
        text-transform: uppercase;
    }

    .ocultar {
        display: none;
    }

    .mostrar {
        display: block;
    }

    /*****************************************/
    /* clases relativas a tablas             */
    /*****************************************/

    .itemParTabla {
        background-color: #ddd;
    }

    .itemImparTabla {
        background-color: #f5f5f5;
    }

    .itemEncimaTabla {
        background-color: #ffc;
    }
</style>
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Matriculación de Estudiantes
        </div>

        <div class="card-body">

            <div class="mb-3">
                <button id="new_student" class="btn btn-primary btn-sm ocultar" data-toggle="modal" data-target="#newStudentModal"><i class="fa fa-plus-circle"></i> Nuevo Estudiante</button>
            </div>

            <div class="mb-3">
                <label for="id_paralelo" class="form-label">Elegir Paralelo:</label>
                <select class="form-select" id="id_paralelo" name="id_paralelo">
                    <option value="">Seleccionar...</option>
                    <?php foreach ($paralelos as $v) : ?>
                        <option value="<?= $v->id_paralelo; ?>" <?= old('id_paralelo') == $v->id_paralelo ? 'selected' : '' ?>><?= $v->cu_nombre . " " . $v->pa_nombre . " - " . $v->es_figura . " - " . $v->jo_nombre; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Línea de división -->
            <hr>
            <!-- message -->
            <div id="text_message" class="text-center"></div>
            <div class="table-responsive">
                <table id="t_estudiantes" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Mat.</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>DNI</th>
                            <th>Fec.Nacim.</th>
                            <th>Edad</th>
                            <th>Género</th>
                            <th>Desertor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aqui desplegamos el contenido de la base de datos -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->

    </div>
</div>

<div class="viewmodal" style="display: none;"></div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $("#text_message").html("Seleccione un paralelo...");

        $('#new_student').attr('disabled', true);

        $("#id_paralelo").on('change', function() {
            let id_paralelo = $(this).val();

            if (id_paralelo == "") {
                $("#text_message").html("Debe seleccionar un paralelo...");
                $("#text_message").fadeIn("slow");
                $("#t_estudiantes tbody").html("");
                $("#new_student").hide();
            } else {
                $("#text_message").fadeOut();
                $('#new_student').attr('disabled', false);
                $("#new_student").show();
                listarEstudiantesParalelo(id_paralelo);
            }
        });

        $('#new_student').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url(route_to('matriculacion_form_crear')) ?>",
                type: "post",
                dataType: "json",
                success: function(response) {
                    // alert(response.data);
                    $('.viewmodal').html(response.data).show();
                    $('#newStudentModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('#t_estudiantes tbody').on('click', '.item-edit', function() {
            let id_estudiante = $(this).attr('data');
            // console.log(id_estudiante);

            $.ajax({
                type: "post",
                url: "<?= base_url(route_to('matriculacion_getStudentById')) ?>",
                data: {
                    id_estudiante: id_estudiante
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('.viewmodal').html(response.success).show();
                        $('#editStudentModal').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

        });
    });

    function listarEstudiantesParalelo(id_paralelo) {
        $.ajax({
            url: "<?= base_url(route_to('matriculacion_listar')) ?>",
            method: "POST",
            data: {
                id_paralelo: id_paralelo
            },
            dataType: "html",
            success: function(response) {
                $("#t_estudiantes tbody").html(response);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>