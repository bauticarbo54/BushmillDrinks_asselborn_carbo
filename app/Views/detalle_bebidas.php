<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= base_url('assets/upload/' . $producto['producto_imagen']) ?>" class="img-fluid" alt="<?= $producto['producto_nombre'] ?>">
        </div>
        <div class="col-md-6">
            <h2><?= esc($producto['producto_nombre']) ?></h2>
            <p><strong>Descripción:</strong> <?= esc($producto['producto_descripcion']) ?></p>
            <p><strong>Precio:</strong> $<?= esc($producto['producto_precio']) ?></p>
            <p><strong>Volumen:</strong> <?= esc($producto['producto_volumen']) ?> ml</p>
            <p><strong>Graduación alcohólica:</strong> <?= esc($producto['producto_grado']) ?>%</p>
            <p><strong>Stock:</strong> <?= esc($producto['producto_stock']) ?></p>

            <?php if (session('perfil_id') == 2): ?>
                <a href="<?= base_url('carrito/agregar/' . $producto['id']) ?>" class="btn btn-success">Agregar al carrito</a>
            <?php endif; ?>
        </div>
    </div>
</div>

