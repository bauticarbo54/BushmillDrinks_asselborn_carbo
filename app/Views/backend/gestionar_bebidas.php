<div class="container mt-4">
    <h1 class="text-center mb-4">Gestión de Bebidas</h1>

   <?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('mensaje') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


    <?= form_open('gestionar_bebidas', ['method' => 'get', 'class' => 'row g-3 mb-3']) ?>
    <div class="row g-2">
        <div class="col-md-4">
            <select name="categoria" class="form-select">
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id_categoria'] ?>" <?= (isset($categoriaSeleccionada) && $categoriaSeleccionada == $categoria['id_categoria']) ? 'selected' : '' ?>>
                        <?= esc($categoria['categoria_nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-5">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre o marca" value="<?= esc($busqueda ?? '') ?>">
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-dark w-100">Filtrar</button>
        </div>
    </div>
    <?= form_close() ?>

    <?php if (empty($productos)): ?>
    <div class="alert alert-warning text-center">
        No se encontraron bebidas con los filtros aplicados.
    </div>
<?php else: ?>

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
                        <a href="<?= site_url('editar_bebida/' . $producto['id_producto']) ?>" class="btn btn-sm btn-warning">Editar</a>
                        <?php if ($producto['producto_estado']): ?>
                            <a href="<?= site_url('deshabilitar_bebida/' . $producto['id_producto']) ?>" class="btn btn-sm btn-secondary mt-1" onclick="return confirm('¿Deseás deshabilitar esta bebida?');">Deshabilitar</a>
                        <?php else: ?>
                            <a href="<?= site_url('habilitar_bebida/' . $producto['id_producto']) ?>" class="btn btn-sm btn-success mt-1" onclick="return confirm('¿Deseás habilitar nuevamente esta bebida?');">Habilitar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>

<script>
    window.setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert) {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        }
    }, 4000);
</script>

