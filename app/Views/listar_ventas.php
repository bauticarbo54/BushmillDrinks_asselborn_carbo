<h2 class="text-2xl font-bold mb-4">Historial de Ventas</h2>

<?php if (!empty($ventas)): ?>
    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th>Cliente</th>
                <th>Producto</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?= esc($venta['cliente']) ?></td>
                    <td><?= esc($venta['producto']) ?></td>
                    <td><?= esc($venta['fecha']) ?></td>
                    <td><?= esc($venta['cantidad']) ?></td>
                    <td>$<?= esc($venta['total']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay ventas registradas.</p>
<?php endif ?>
