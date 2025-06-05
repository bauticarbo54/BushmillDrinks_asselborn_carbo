<div class="container mt-4">
    <h2 class="mb-4">Catálogo de Bebidas</h2>
    <div class="row">
        <?php foreach ($productos as $producto): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="<?= base_url('assets/upload/' . $producto['producto_imagen']) ?>" class="card-img-top" alt="<?= $producto['producto_nombre'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($producto['producto_nombre']) ?></h5>
                        <p class="card-text">$<?= esc($producto['producto_precio']) ?></p>
                        <a href="<?= base_url('detalle/' . $producto['id_producto']) ?>" class="btn btn-primary btn-sm">Ver más</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

