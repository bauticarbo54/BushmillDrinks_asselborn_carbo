<h1 class="text-center mb-4">Consultas de Clientes</h1>

<div class="container">
    <?php if (session('mensaje')): ?>
        <div class="alert alert-success">
            <?= session('mensaje'); ?>
        </div>
    <?php endif; ?>

    <?php if (empty($mensajes)): ?>
        <div class="alert alert-info">No hay consultas por el momento.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Consulta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mensajes as $mensaje): ?>
                        <tr>
                            <td><?= esc($mensaje['id_mensaje']) ?></td>
                            <td><?= esc($mensaje['mensaje_nombre']) ?></td>
                            <td><?= esc($mensaje['mensaje_mail']) ?></td>
                            <td><?= esc($mensaje['mensaje_telefono']) ?></td>
                            <td><?= esc($mensaje['mensaje_consulta']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
