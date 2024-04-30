<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Cierre de Periodos
<?= $this->endsection('title') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">

    <div class="card mt-2">
        <div class="card-header">
            <i class="fa fa-puzzle-piece me-1"></i>
            Cierre de Periodos
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table id="t_cierres_periodos" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Aporte</th>
                                <th>Paralelo</th>
                                <th>Figura</th>
                                <th>Jornada</th>
                                <th>Fecha de Apertura</th>
                                <th>Fecha de Cierre</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_cierres_periodos">
                            <!-- Aquí se pintarán los registros recuperados de la BD mediante AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        listarCierresPeriodos();

    });

    function listarCierresPeriodos() {
        var request = $.ajax({
            url: "<?= base_url(route_to('cierre_periodos_listar')) ?>",
            method: "get",
            dataType: "json"
        });

        request.done(function(data) {
            var html = '';
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    let estado = data[i].ap_estado == 'C' ? 'CERRADO' : 'ABIERTO';
                    html += '<tr>' +
                        '<td>' + data[i].id_aporte_paralelo_cierre + '</td>' +
                        '<td>' + data[i].ap_nombre + '</td>' +
                        '<td>' + data[i].cu_nombre + ' ' + data[i].pa_nombre + '</td>' +
                        '<td>' + data[i].es_figura + '</td>' +
                        '<td>' + data[i].jo_nombre + '</td>' +
                        '<td>' + data[i].ap_fecha_apertura + '</td>' +
                        '<td>' + data[i].ap_fecha_cierre + '</td>' +
                        '<td>' + estado + '</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<a href="javascript:;" class="btn btn-warning item-edit" data="' + data[i].id_aporte_paralelo_cierre +
                        '" title="Editar"><span class="fa fa-pencil"></span></a>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                }
                $("#tbody_cierres_periodos").html(html);
            } else {
                html += '<tr><td colspan="9">No se han ingresado Cierres de Periodos todavía...</td></tr>';
                $("#tbody_cierres_periodos").html(html);
            }
        });

        request.fail(function(jqXHR, textStatus) {
            alert("Requerimiento fallido: " + jqXHR.responseText);
        });
    }
</script>
<?= $this->endsection('scripts') ?>