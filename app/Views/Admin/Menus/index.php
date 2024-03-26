<?= $this->extend('layouts/layout') ?>

<?= $this->section('title') ?>
Menus
<?= $this->endsection('title') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?php echo base_url() ?>Assets/css/jquery.nestable.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .menu_link a {
        color: #000;
        text-decoration: none;
    }

    .menu_link a:hover {
        color: #0066ff;
    }
</style>
<?= $this->endsection('css') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Administración de Menus</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listado
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <button id="btn_nuevo_menu" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nuevoMenuModal"><i class="fa fa-plus-circle"></i> Nuevo Menú</button>
                    <menu id="nestable-menu">
                        <button id="btn_expandir_todo" class="btn btn-sm btn-success" data-action="expand-all"><i class="fa-solid fa-chevron-down"></i> Expandir Todo</button>
                        <button id="btn_colapsar_todo" class="btn btn-sm btn-danger" data-action="collapse-all"><i class="fa-solid fa-chevron-up"></i> Colapsar Todo</button>
                    </menu>
                    <!-- <form> -->
                        <div class="mb-3">
                            <label for="id_perfil" class="form-label">Elegir perfil:</label>
                            <select class="form-select" id="id_perfil" name="id_perfil">
                                <option value="">Seleccionar...</option>
                                <?php
                                foreach ($perfiles as $perfil) {
                                ?>
                                    <option value="<?php echo $perfil->id_perfil; ?>"><?php echo $perfil->pe_nombre; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">
                    <!-- Aquí va el listado de menús -->
                    <div id="menu">
                        <div class="dd" id="nestable">
                            <ol class="dd-list viewdata">

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display: none;"></div>
<?= $this->endsection('content') ?>

<?= $this->section('scripts') ?>
<script src="<?php echo base_url() ?>Assets/js/jquery.nestable.js"></script>
<script>
    $(document).ready(function() {
        // deshabilitar el botón nuevo menú
        $("#btn_nuevo_menu").attr('disabled', true);
        $("#btn_expandir_todo").attr('disabled', true);
        $("#btn_colapsar_todo").attr('disabled', true);

        // activate Nestable
        $('#nestable').nestable().on('change', function() {
            const id_perfil = $("#id_perfil").val();
            $.ajax({
                url: "<?= base_url(route_to('menus_guardar_orden')) ?>",
                type: 'POST',
                data: {
                    menu: JSON.stringify($('#nestable').nestable('serialize'))
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    listarMenus(id_perfil);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('#nestable-menu').on('click', function(e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $("#id_perfil").change(function(e) {
            const id_perfil = $(this).val();
            if (id_perfil !== "") {
                $("#btn_nuevo_menu").attr('disabled', false);
                $("#btn_expandir_todo").attr('disabled', false);
                $("#btn_colapsar_todo").attr('disabled', false);
                listarMenus(id_perfil);
            } else {
                Swal.fire({
                    title: "Menús",
                    text: "Tiene que elegir un perfil...",
                    icon: "info"
                });

                $("#btn_nuevo_menu").attr('disabled', true);
                $("#btn_expandir_todo").attr('disabled', true);
                $("#btn_colapsar_todo").attr('disabled', true);
                $(".viewdata").html("");
            }
        });

        $('#btn_nuevo_menu').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url(route_to('menus_form_crear')) ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#nuevoMenuModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function listarMenus(id_perfil) {
        $.ajax({
            type: "post",
            url: "<?= base_url(route_to('menus_data')) ?>",
            data: {
                id_perfil: id_perfil
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function edit(e, obj, id_menu) {
        e.preventDefault();

        const url = $(obj).attr("href");

        $.ajax({
            type: "post",
            url: url,
            data: {
                id_menu: id_menu
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewmodal').html(response.success).show();
                    $('#editarMenuModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function eliminar(e, obj, id_menu) {
        e.preventDefault();

        const id_perfil = $("#id_perfil").val();

        const url = $(obj).attr("href");

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
                    url: url,
                    data: {
                        id_menu: id_menu
                    },
                    dataType: "json",
                    success: function(response) {
                        // if (response.success) {
                            Swal.fire({
                                icon: response.icon,
                                title: "Eliminar",
                                text: response.message,
                            });

                            listarMenus(id_perfil);
                        // }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>
<?= $this->endsection('scripts') ?>