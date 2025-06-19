<h2 class="text-2xl font-bold mb-4">Historial de Ventas</h2>

<?php if (!empty($ventas)): ?>
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead>
            <tr class="bg-gray-100">
                <th>ID Venta</th>
                <th>Cliente</th>
                <th>Mail</th>
                <th>Direccion</th>
                <th>Cod. Postal</th>                
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?= esc($venta['id_venta']) ?></td>
                    <td><?= esc($venta['id_cliente']) ?></td>
                    <td><?= esc($venta['envio_mail']) ?></td>
                    <td><?= esc($venta['envio_direccion']) ?></td>
                    <td><?= esc($venta['envio_codigo']) ?></td>
                    <td><?= esc($venta['venta_fecha']) ?></td>
                    <td><?= esc($venta['id_producto']) ?></td>
                    <td><?= esc($venta['detalle_cantidad']) ?></td>
                    <td>$<?= esc($venta['detalle_precio']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay ventas registradas.</p>
<?php endif ?>
