<div class="container mt-4">
    <h2>Gestión de Bebidas</h2>

    <table class="table table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Volumen (ml)</th>
                <th>Grado (%)</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><img src="<?= base_url('assets/upload/' . $producto['producto_imagen']) ?>" width="60"></td>
                    <td><?= esc($producto['producto_nombre']) ?></td>
                    <td><?= esc($producto['producto_descripcion']) ?></td>
                    <td>$<?= number_format($producto['producto_precio'], 2) ?></td>
                    <td><?= esc($producto['producto_stock']) ?></td>
                    <td><?= esc($producto['producto_volumen']) ?></td>
                    <td><?= esc($producto['producto_grado']) ?></td>
                    <td><?= esc($producto['marca_nombre']) ?></td>
                    <td><?= esc($producto['categoria_nombre']) ?></td>
                    <td>
                        <a href="<?= site_url('gestionar_bebidas/' . $producto['id_producto']) ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="<?= site_url('productos/eliminar/' . $producto['id_producto']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Deseás eliminar esta bebida?');">Eliminar</a>
                        <!-- Agregá una acción para deshabilitar si implementás soft delete -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
