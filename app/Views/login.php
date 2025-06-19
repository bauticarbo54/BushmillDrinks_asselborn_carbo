<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow rounded" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4">Iniciar Sesión</h3>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" 
                       class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                       id="email" 
                       name="email" 
                       value="<?= set_value('email') ?>" 
                       placeholder="ejemplo@correo.com">
                <?php if (isset($validation) && $validation->hasError('email')): ?>
                    <small class="text-danger"><?= $validation->getError('email') ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" 
                       class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" 
                       id="password" 
                       name="password">
                <?php if (isset($validation) && $validation->hasError('password')): ?>
                    <small class="text-danger"><?= $validation->getError('password') ?></small>
                <?php endif; ?>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark">Ingresar</button>
            </div>

            <div class="text-center mt-3">
                <small>¿No tenés una cuenta? 
                    <a class="linkPersonalizado" href="<?= base_url('registro') ?>">Registrate</a>
                </small>
            </div>
        </form>
    </div>
</div>
