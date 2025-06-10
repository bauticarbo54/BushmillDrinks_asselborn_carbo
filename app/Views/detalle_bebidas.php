<div class="container mt-5">
    <div class="row g-5 align-items-center">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <img src="<?= base_url('assets/upload/' . $producto['producto_imagen']) ?>" class="img-fluid rounded-4" alt="<?= esc($producto['producto_nombre']) ?>">
            </div>
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <h2 class="fw-bold mb-3"><?= esc($producto['producto_nombre']) ?></h2>
            
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>Descripción:</strong> <?= esc($producto['producto_descripcion']) ?></li>
                <li class="list-group-item"><strong>Precio:</strong> <span class="text-success fw-semibold">$<?= esc($producto['producto_precio']) ?></span></li>
                <li class="list-group-item"><strong>Volumen:</strong> <?= esc($producto['producto_volumen']) ?> ml</li>
                <li class="list-group-item"><strong>Graduación alcohólica:</strong> <?= esc($producto['producto_grado']) ?>%</li>
                <li class="list-group-item"><strong>Stock disponible:</strong> <?= esc($producto['producto_stock']) ?></li>
            </ul>

            <?php if (session('perfil_id') == 2): ?>
                <a href="<?= base_url('carrito/agregar/' . $producto['id']) ?>" class="btn btn-success btn-lg">
                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
