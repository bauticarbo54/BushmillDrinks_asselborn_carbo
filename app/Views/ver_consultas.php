<h2 class="text-2xl font-bold mb-4">Consultas de Usuarios</h2>

<?php if (!empty($consultas)): ?>
    <table class="table-auto w-full border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?= esc($consulta['nombre']) ?></td>
                    <td><?= esc($consulta['email']) ?></td>
                    <td><?= esc($consulta['mensaje']) ?></td>
                    <td><?= esc($consulta['fecha']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay consultas registradas.</p>
<?php endif ?>