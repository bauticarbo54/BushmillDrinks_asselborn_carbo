<div class="container mt-5">
    <h2 class="mb-4">Listado de Usuarios</h2>

    <!-- Formulario de búsqueda y filtros -->
    <form method="get" action="<?= site_url('usuarios') ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="perfil" class="form-label">Filtrar por perfil</label>
            <select name="perfil" id="perfil" class="form-select">
                <option value="">Todos</option>
                <option value="1" <?= (isset($_GET['perfil']) && $_GET['perfil'] == '1') ? 'selected' : '' ?>>Administrador</option>
                <option value="2" <?= (isset($_GET['perfil']) && $_GET['perfil'] == '2') ? 'selected' : '' ?>>Cliente</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="email" class="form-label">Buscar por email</label>
            <input type="text" name="email" id="email" value="<?= esc($_GET['email'] ?? '') ?>" class="form-control" placeholder="Ej: ejemplo@mail.com">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filtrar</button>
            <a href="<?= site_url('usuarios') ?>" class="btn btn-secondary">Reiniciar</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($usuarios) > 0): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id_usuario'] ?></td>
                            <td><?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?></td>
                            <td><?= esc($usuario['usuario']) ?></td>
                            <td><?= esc($usuario['email']) ?></td>
                            <td>
                                <span class="badge bg-<?= $usuario['perfil_id'] == 1 ? 'primary' : 'secondary' ?>">
                                    <?= $usuario['perfil_id'] == 1 ? 'Admin' : 'Cliente' ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?= $usuario['baja'] == 'si' ? 'danger' : 'success' ?>">
                                    <?= $usuario['baja'] == 'si' ? 'Suspendido' : 'Activo' ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if (session('id_usuario') != $usuario['id_usuario']): ?>
                                    <?php if ($usuario['baja'] == 'si'): ?>
                                        <a href="<?= site_url('habilitar_usuario/' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-success mb-1">Habilitar</a>
                                    <?php else: ?>
                                        <a href="<?= site_url('suspender_usuario/' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-warning mb-1">Suspender</a>
                                    <?php endif; ?>
                                    
                                    <a href="<?= site_url('cambiar_tipo_usuario/' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-info mb-1 text-white">Cambiar tipo</a>

                                    <a href="<?= site_url('eliminar_usuario/' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">Tu cuenta</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron usuarios con los filtros aplicados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

