<div class="container mt-4">
<h2>Lista de Bebidas</h2>

<?= form_open('listar_bebidas', ['method' => 'get', 'class' => 'mb-4']) ?>
<div class="row g-2">
    <div class="col-md-4">
        <select name="categoria_id" class="form-select">
            <option value="">Todas las categorías</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id_categoria'] ?>" <?= (isset($_GET['categoria_id']) && $_GET['categoria_id'] == $cat['id_categoria']) ? 'selected' : '' ?>>
                    <?= esc($cat['categoria_nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-5">
        <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre o marca" value="<?= esc($_GET['busqueda'] ?? '') ?>">
    </div>

    <div class="col-md-3 d-grid">
        <button type="submit" class="btn btn-dark">Filtrar</button>
    </div>
</div>
<?= form_close() ?>

<?php if (empty($productos)): ?>
    <div class="alert alert-warning text-center">
        No se encontraron productos con los criterios ingresados.
    </div>
<?php else: ?>


<table class="table table-striped table-hover table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= esc($producto['producto_nombre']) ?></td>
                <td><?= esc($producto['marca_nombre']) ?></td>
                <td>$<?= number_format($producto['producto_precio'], 2) ?></td>
                <td><?= esc($producto['producto_stock']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>
