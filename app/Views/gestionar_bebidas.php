<h2 class="text-2xl font-bold mb-4">Gestionar Bebidas</h2>

<a href="<?= base_url('producto_controller/crear') ?>" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Nueva</a>

<table class="table-auto w-full border mt-4">
    <thead>
        <tr class="bg-gray-100">
            <th>Nombre</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= esc($producto['producto_nombre']) ?></td>
                <td><?= esc($producto['producto_stock']) ?></td>
                <td>$<?= esc($producto['producto_precio']) ?></td>
                <td>
                    <a href="<?= base_url('producto_controller/editar/'.$producto['id']) ?>">Editar</a> |
                    <a href="<?= base_url('producto_controller/eliminar/'.$producto['id']) ?>" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
