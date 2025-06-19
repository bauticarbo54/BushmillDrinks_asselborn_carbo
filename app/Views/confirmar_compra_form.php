<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">📦 Datos de Envío</h1>
        <a href="<?= base_url('ver_carrito') ?>" class="btn btn-outline-success">← Volver al carrito</a>
    </div>

    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body p-4">
            <form method="post" action="<?= base_url('confirmar_compra') ?>">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">📱 Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="envio_telefono" placeholder="Ej: 3794 123456" required value="<?= set_value('envio_telefono') ?>">
                        <?php if (isset($validation) && $validation->hasError('envio_telefono')): ?>
                            <div class="text-danger small"><?= $validation->getError('envio_telefono') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">✉️ Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="envio_mail" placeholder="nombre@ejemplo.com" required value="<?= set_value('envio_mail') ?>">
                        <?php if (isset($validation) && $validation->hasError('envio_mail')): ?>
                            <div class="text-danger small"><?= $validation->getError('envio_mail') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="provincia" class="form-label">🌎 Provincia</label>
                        <select name="envio_provincia" id="provincia" class="form-select" required>
                            <option value="">-- Selecciona una provincia --</option>
                            <?php
                            $provincias = ["Buenos Aires", "Catamarca", "Chaco", "Chubut", "Córdoba", "Corrientes", "Entre Ríos", "Formosa", "Jujuy", "La Pampa", "La Rioja", "Mendoza", "Misiones", "Neuquén", "Río Negro", "Salta", "San Juan", "San Luis", "Santa Cruz", "Santa Fe", "Santiago del Estero", "Tierra del Fuego", "Tucumán"];
                            foreach ($provincias as $prov):
                            ?>
                                <option value="<?= $prov ?>" <?= set_value('envio_provincia') === $prov ? 'selected' : '' ?>><?= $prov ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="ciudad" class="form-label">🏙️ Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="envio_ciudad" placeholder="Ej: Resistencia" required value="<?= set_value('envio_ciudad') ?>">
                        <?php if (isset($validation) && $validation->hasError('envio_ciudad')): ?>
                            <div class="text-danger small"><?= $validation->getError('envio_ciudad') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="codigo" class="form-label">📮 Código Postal</label>
                        <input type="number" class="form-control" id="codigo" name="envio_codigo" placeholder="Ej: 3500" required value="<?= set_value('envio_codigo') ?>">
                        <?php if (isset($validation) && $validation->hasError('envio_codigo')): ?>
                            <div class="text-danger small"><?= $validation->getError('envio_codigo') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="direccion" class="form-label">🏠 Dirección de Entrega</label>
                        <input type="text" class="form-control" id="direccion" name="envio_direccion" placeholder="Ej: Av. Siempreviva 742" required value="<?= set_value('envio_direccion') ?>">
                        <?php if (isset($validation) && $validation->hasError('envio_direccion')): ?>
                            <div class="text-danger small"><?= $validation->getError('envio_direccion') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 py-2">Confirmar Envío</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
