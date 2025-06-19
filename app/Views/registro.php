<?php helper('form'); ?>

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow rounded" style="max-width: 500px; width: 100%;">
            <h3 class="text-center mb-4">Crear una cuenta</h3>
            <form action="form_registro" method="POST">
                <input type="hidden" name="perfil_id" value="2">

                
                <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nombre') ? 'is-invalid' : '' ?>" id="nombre" name="nombre" value="<?= set_value('nombre') ?>" required>
            <?php if (isset($validation) && $validation->hasError('nombre')): ?>
                <small class="text-danger"><?= $validation->getError('nombre') ?></small>
            <?php endif; ?> 
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('apellido') ? 'is-invalid' : '' ?>" 
                id="apellido" name="apellido" value="<?= set_value('apellido') ?>" required>
            <?php if (isset($validation) && $validation->hasError('apellido')): ?>
                <small class="text-danger"><?= $validation->getError('apellido') ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('usuario') ? 'is-invalid' : '' ?>" 
                id="usuario" name="usuario" value="<?= set_value('usuario') ?>" required>
            <?php if (isset($validation) && $validation->hasError('usuario')): ?>
                <small class="text-danger"><?= $validation->getError('usuario') ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                id="email" name="email" value="<?= set_value('email') ?>" placeholder="ejemplo@correo.com" required>
            <?php if (isset($validation) && $validation->hasError('email')): ?>
                <small class="text-danger"><?= $validation->getError('email') ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control <?= isset($validation) && $validation->hasError('pass') ? 'is-invalid' : '' ?>" 
                id="pass" name="pass" required>
            <?php if (isset($validation) && $validation->hasError('pass')): ?>
                <small class="text-danger"><?= $validation->getError('pass') ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="confirmar" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control <?= isset($validation) && $validation->hasError('confirmar_pass') ? 'is-invalid' : '' ?>" 
                id="confirmar_pass" name="confirmar_pass" required>
            <?php if (isset($validation) && $validation->hasError('confirmar_pass')): ?>
                <small class="text-danger"><?= $validation->getError('confirmar_pass') ?></small>
            <?php endif; ?>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Registrarse</button>
        </div>
            </form>
        </div>
    </div>    