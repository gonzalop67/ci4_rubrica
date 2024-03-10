<table id="tbl_usuarios" class="table table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>Avatar</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Activo</th>
            <th>Perfiles</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php

        use App\Models\Admin\UsuariosModel;

        $usuarioModel = new UsuariosModel();
        $contador = 0;
        foreach ($usuarios as $v) {
            $contador++;
        ?>
            <tr>
                <td><?= $contador; ?></td>
                <td><?= $v->id_usuario; ?></td>
                <td>
                    <img src="<?= base_url() . "avatars/" . $v->us_foto; ?>" class="img-thumbnail" width="50" alt="Avatar del Usuario">
                </td>
                <td><?= $v->us_apellidos . " " . $v->us_nombres; ?></td>
                <td><?= $v->us_login; ?></td>
                <td>
                    <?php if ($v->us_activo == 1) : ?>
                        <span class="badge bg-success">Activo</span>
                    <?php else : ?>
                        <span class="badge bg-danger">Inactivo</span>
                    <?php endif ?>
                </td>
                <?php
                $perfiles = $usuarioModel->getRols($v->id_usuario);
                $cadena_perfiles = "";
                foreach ($perfiles as $perfil) {
                    $cadena_perfiles .= $perfil->pe_nombre . ", ";
                }
                $cadena_perfiles = rtrim($cadena_perfiles, ", ");
                ?>
                <td>
                    <?= $cadena_perfiles; ?>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="<?= base_url(route_to('usuarios_edit', $v->id_usuario)) ?>" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(<?= $v->id_usuario ?>)"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>