<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Mallas Curriculares
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Mallas Curriculares
        </div>

        <div class="card-body">
            <button id="btn_nuevo_item" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nuevoItemModal"><i class="fa fa-plus-circle"></i> Nuevo Registro</button>
            <hr>
            <div class="mb-3">
                <label for="id_curso" class="form-label">Elegir Curso:</label>
                <select class="form-select" id="id_curso" name="id_curso">
                    <option value="">Seleccionar...</option>
                    <?php
                    foreach ($cursos as $v) {
                    ?>
                        <option value="<?= $v->id_curso; ?>"><?= "[" . $v->es_figura . "] - " . $v->cu_nombre; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Asignatura</th>
                                <th>Curso</th>
                                <th>Presencial</th>
                                <th>Autónomo</th>
                                <th>Tutoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="viewdata">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-10 text-end">
                    <label class="control-label" style="position:relative; top:7px;">Total Horas:</label>
                </div>
                <div class="col-2" style="margin-top: 2px;">
                    <input type="text" class="form-control text-end" id="total_horas" value="0" disabled>
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
        $('#id_curso').select2();

        $(".viewdata").html("<tr><td colspan='7' align='center'>Debe seleccionar un curso...</td></tr>");

        $('#btn_nuevo_item').attr('disabled', true);

        $("#id_curso").change(function(e) {
            const id_curso = $(this).val();
            if (id_curso !== "") {
                $('#btn_nuevo_item').attr('disabled', false);
                listarItems(id_curso);
            } else {
                $('#btn_nuevo_item').attr('disabled', true);
                Swal.fire({
                    title: "Mallas Curriculares",
                    text: "Tiene que elegir un curso...",
                    icon: "info"
                });
            }
        });

        $('#btn_nuevo_item').click(function(e) {
            e.preventDefault();

            const id_curso = $("#id_curso").val();

            $.ajax({
                type: "post",
                url: "<?= base_url(route_to('mallas_curriculares_form_crear')) ?>",
                data: {
                    id_curso: id_curso
                },
                dataType: "json",
                success: function(response) {
                    // alert(response.data);
                    $('.viewmodal').html(response.data).show();
                    $('#nuevoItemModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function listarItems(id_curso) {
        var request = $.ajax({
            url: "<?= base_url(route_to('mallas_curriculares_data')) ?>",
            method: "post",
            data: {
                id_curso: id_curso
            },
            dataType: "json"
        });

        request.done(function(data) {
            // alert(data);
            var datos = JSON.parse(data);
            $(".viewdata").html(datos.cadena);
            $("#total_horas").val(datos.total_horas);
            $("#text_message").html("");
        });

        request.fail(function(jqXHR, textStatus) {
            alert("Requerimiento fallido: " + jqXHR.responseText);
        });
    }
</script>
<?= $this->endsection('scripts') ?>