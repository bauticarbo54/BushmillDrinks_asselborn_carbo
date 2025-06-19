<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>


<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow rounded" style="max-width: 500px; width: 100%;">
        <h3 class="text-center mb-4">Editar perfil</h3>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger">
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="alert alert-success">
                <?= esc($success) ?>
            </div>
        <?php endif; ?>

        <?= form_open('actualizar_perfil') ?>
            <input type="hidden" name="id_usuario" value="<?= esc($usuario['id_usuario']) ?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= old('nombre', $usuario['nombre']) ?>">
                <?php if (isset($validation['nombre'])): ?>
                    <small class="text-danger"><?= esc($validation['nombre']) ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="<?= old('apellido', $usuario['apellido']) ?>">
                <?php if (isset($validation['apellido'])): ?>
                    <small class="text-danger"><?= esc($validation['apellido']) ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="usuario" value="<?= old('usuario', $usuario['usuario']) ?>">
                <?php if (isset($validation['usuario'])): ?>
                    <small class="text-danger"><?= esc($validation['usuario']) ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" value="<?= old('email', $usuario['email']) ?>">
                <?php if (isset($validation['email'])): ?>
                    <small class="text-danger"><?= esc($validation['email']) ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="pass" class="form-label">Nueva contraseña (opcional)</label>
                <input type="password" class="form-control" name="pass">
                <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                <?php if (isset($validation['pass'])): ?>
                    <small class="text-danger d-block"><?= esc($validation['pass']) ?></small>
                <?php endif; ?>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        <?= form_close() ?>
    </div>
</div>


