<div class="container mt-4">
    <h1 class="text-center mb-4">Mis Compras</h1>

    <?php if (!empty($ventas)): ?>
        <div class="accordion" id="comprasAccordion">
            <?php foreach ($ventas as $venta): ?>
                <div class="accordion-item mb-3 border rounded-3">
                    <h2 class="accordion-header" id="heading<?= $venta['id_venta'] ?>">
                        <button class="accordion-button collapsed py-3" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse<?= $venta['id_venta'] ?>"
                                aria-expanded="false"
                                aria-controls="collapse<?= $venta['id_venta'] ?>">
                            <div class="d-flex justify-content-between w-100 pe-3 align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold">Compra #<?= $venta['id_venta'] ?></h6>
                                    <small class="text-muted"><?= date('d/m/Y', strtotime($venta['fecha'])) ?></small>
                                </div>
                                <span class="badge bg-success fs-6">$<?= number_format($venta['total'], 2, ',', '.') ?></span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse<?= $venta['id_venta'] ?>" class="accordion-collapse collapse"
                         aria-labelledby="heading<?= $venta['id_venta'] ?>" data-bs-parent="#comprasAccordion">
                        <div class="accordion-body pt-4">
                            <div class="mb-4">
                                <h5><i class="bi bi-geo-alt-fill me-2"></i> Envío</h5>
                                <p><strong>Dirección:</strong> <?= esc($venta['envio_direccion']) ?></p>
                                <p><strong>Código Postal:</strong> <?= esc($venta['envio_codigo']) ?></p>
                                <p><strong>Email de contacto:</strong> <?= esc($venta['envio_mail']) ?></p>
                            </div>

                            <h5 class="mb-3"><i class="bi bi-cart-check me-2"></i>Productos Comprados</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Producto</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-end">Precio Unitario</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($venta['productos'] as $producto): ?>
                                            <tr>
                                                <td><?= esc($producto['nombre']) ?></td>
                                                <td class="text-center"><?= $producto['cantidad'] ?></td>
                                                <td class="text-end">$<?= number_format($producto['precio_unitario'], 2, ',', '.') ?></td>
                                                <td class="text-end">$<?= number_format($producto['subtotal'], 2, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="table-active fw-bold">
                                            <td colspan="3" class="text-end">Total:</td>
                                            <td class="text-end">$<?= number_format($venta['total'], 2, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle-fill me-2"></i> Aún no realizaste compras en el sistema.
        </div>
    <?php endif; ?>
</div>
