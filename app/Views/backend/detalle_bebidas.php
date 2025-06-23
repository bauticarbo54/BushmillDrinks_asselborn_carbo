<div class="container mt-5 mb-5">
    <div class="row g-5 align-items-center">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <img src="<?= base_url('assets/upload/' . $producto['producto_imagen']) ?>" class="img-fluid rounded-4" alt="<?= esc($producto['producto_nombre']) ?>">
            </div>
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <?php if (session()->getFlashdata('error_stock')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error_stock') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('mensaje') ?>
                </div>
            <?php endif; ?>

            <h2 class="fw-bold mb-3"><?= esc($producto['producto_nombre']) ?></h2>
            
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>Descripción:</strong> <?= esc($producto['producto_descripcion']) ?></li>
                <li class="list-group-item">
                    <strong>Precio:</strong>
                    <?php if ($producto['producto_oferta'] && $producto['producto_oferta_precio'] !== null): ?>
                        <span class="text-muted text-decoration-line-through">
                            $<?= number_format($producto['producto_precio'], 2, ',', '.') ?>
                        </span>
                        <br>
                        <span class="text-success fw-semibold">
                            $<?= number_format($producto['producto_oferta_precio'], 2, ',', '.') ?>
                        </span>
                        <br>
                        <span class="badge bg-success">
                            <?= round(100 - ($producto['producto_oferta_precio'] / $producto['producto_precio']) * 100) ?>% OFF
                        </span>
                    <?php else: ?>
                        <span class="text-success fw-semibold">
                            $<?= number_format($producto['producto_precio'], 2, ',', '.') ?>
                        </span>
                    <?php endif; ?>
                </li>
                <li class="list-group-item"><strong>Volumen:</strong> <?= esc($producto['producto_volumen']) ?>ml</li>
                <li class="list-group-item"><strong>Graduación alcohólica:</strong> <?= esc($producto['producto_grado']) ?>%</li>
                <li class="list-group-item"><strong>Stock disponible:</strong> <?= esc($producto['producto_stock']) ?></li>
            </ul>

            <?php if (session('perfil_id') == 2): ?>
                <?php
                    $precio = $producto['producto_oferta'] && $producto['producto_oferta_precio'] !== null
                        ? $producto['producto_oferta_precio']
                        : $producto['producto_precio'];
                ?>
                <?= form_open('agregar_carrito') ?>
                <?= form_hidden('id', $producto['id_producto']) ?>
                <?= form_hidden('nombre', $producto['producto_nombre']) ?>
                <?= form_hidden('precio', $precio) ?>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                </button>
                <?= form_close() ?>
                <?php else: ?>
                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Debe iniciar sesión como cliente para comprar.">
                        <button class="btn btn-success btn-lg" type="button" disabled>
                            <i class="bi bi-cart-plus"></i> Agregar al carrito
                        </button>
                    </span>
                <?php endif; ?>

        </div>
    </div>
</div>
