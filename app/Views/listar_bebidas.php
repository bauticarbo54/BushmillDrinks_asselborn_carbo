<h2 class="text-2xl font-bold mb-4">Lista de Bebidas</h2>

<table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-100">
            <th>Nombre</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= esc($producto['producto_nombre']) ?></td>
                <td><?= esc($producto['marca_nombre']) ?></td>
                <td>$<?= esc($producto['producto_precio']) ?></td>
                <td><?= esc($producto['producto_stock']) ?></td>
                <td>
                    <a href="<?= base_url('producto_controller/editar/'.$producto['id']) ?>">Editar</a> |
                    <a href="<?= base_url('producto_controller/eliminar/'.$producto['id']) ?>" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
