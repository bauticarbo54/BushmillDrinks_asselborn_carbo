<?php helper('form'); ?>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow rounded" style="max-width: 500px; width: 100%;">
            <h3 class="text-center mb-4">Crear una cuenta</h3>
            <form action="form_registro" method="POST">
                <input type="hidden" name="perfil_id" value="2">

                
                <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nombre') ? 'is-invalid' : '' ?>" id="nombre" name="nombre" value="<?= set_value('nombre') ?>" required>
            <?php if (isset($validation) && $validation->hasError('nombre')): ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('nombre') ?>
                </div>
            <?php endif; ?> 
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('apellido') ? 'is-invalid' : '' ?>" 
                id="apellido" name="apellido" value="<?= set_value('apellido') ?>" required>
            <?php if (isset($validation) && $validation->hasError('apellido')): ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('apellido') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('usuario') ? 'is-invalid' : '' ?>" 
                id="usuario" name="usuario" value="<?= set_value('usuario') ?>" required>
            <?php if (isset($validation) && $validation->hasError('usuario')): ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('usuario') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                id="email" name="email" value="<?= set_value('email') ?>" placeholder="ejemplo@correo.com" required>
            <?php if (isset($validation) && $validation->hasError('email')): ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control <?= isset($validation) && $validation->hasError('pass') ? 'is-invalid' : '' ?>" 
                id="pass" name="pass" required>
            <?php if (isset($validation) && $validation->hasError('pass')): ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('pass') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="confirmar" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control <?= isset($validation) && $validation->hasError('confirmar_pass') ? 'is-invalid' : '' ?>" 
                id="confirmar_pass" name="confirmar_pass" required>
            <?php if (isset($validation) && $validation->hasError('confirmar_pass')): ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('confirmar_pass') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Registrarse</button>
        </div>
            </form>
        </div>
    </div>    