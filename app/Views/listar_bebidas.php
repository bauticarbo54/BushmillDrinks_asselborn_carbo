<h2 class="h4 fw-bold mb-4">Lista de Bebidas</h2>

<table class="table table-striped table-hover table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Stock</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= esc($producto['producto_nombre']) ?></td>
                <td><?= esc($producto['marca_nombre']) ?></td>
                <td>$<?= number_format($producto['producto_precio'], 2) ?></td>
                <td><?= esc($producto['producto_stock']) ?></td>
                <td class="text-center">
                    <a href="<?= base_url('gestionar_bebidas/'.$producto['id_producto']) ?>" 
                       class="btn btn-sm btn-outline-primary me-2">
                        Editar
                    </a>
                    <a href="<?= base_url('eliminar_bebida/'.$producto['id_producto']) ?>" 
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('¿Seguro que deseas eliminar esta bebida?')">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
