<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="text-success fw-bold">✅ ¡Gracias por tu compra, <?= esc($usuario['nombre']) ?>!</h1>
        <p>Te enviamos un correo a <strong><?= esc($envio['envio_mail']) ?></strong> con los detalles.</p>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">📦 Datos de Envío</div>
        <div class="card-body">
            <p><strong>Teléfono:</strong> <?= esc($envio['envio_telefono']) ?></p>
            <p><strong>Dirección:</strong> <?= esc($envio['envio_direccion']) ?>, <?= esc($envio['envio_ciudad']) ?> (<?= esc($envio['envio_codigo']) ?>), <?= esc($envio['envio_provincia']) ?></p>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-secondary text-white">🧾 Detalles de la Compra</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; $total = 0; ?>
                    <?php foreach ($carrito as $item): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($item['name']) ?></td>
                            <td>$<?= number_format($item['price'], 2, ',', '.') ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td>$<?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                        </tr>
                        <?php $total += $item['subtotal']; ?>
                    <?php endforeach; ?>
                    <tr class="fw-bold table-light">
                        <td colspan="4" class="text-end">Total:</td>
                        <td>$<?= number_format($total, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="<?= base_url('productos') ?>" class="btn btn-outline-primary">Volver al catálogo</a>
    </div>
</div>
