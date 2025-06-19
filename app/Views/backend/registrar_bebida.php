<div class="container mt-4">
<h1 class="text-center mb-4"><?= isset($producto) ? 'Editar Bebida' : 'Registro de Bebida' ?></h1>

<div class="container">
    <div class="w-50 mx-auto">
        <?php if (!empty($validation)): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($validation as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <?php if(session('mensaje')): ?>
            <div class="alert alert-success">
                <?= session('mensaje'); ?>
            </div>
        <?php endif ?>

        <?php
            $url = isset($producto) ? 'actualizar_bebida/'.$producto['id_producto'] : 'insertar_bebida';
            echo form_open_multipart($url);
        ?>

        <div class="form-group">
            <label for="producto_nombre">Nombre de la bebida</label>
            <?= form_input([
                'name' => 'producto_nombre',
                'id' => 'producto_nombre',
                'class' => 'form-control',
                'placeholder' => 'Ingrese el nombre de la bebida',
                'value' => set_value('producto_nombre', $producto['producto_nombre'] ?? '')
            ]) ?>
        </div>

        <div class="form-group">
            <label for="producto_descripcion">Descripción</label>
            <?= form_textarea([
                'name' => 'producto_descripcion',
                'id' => 'producto_descripcion',
                'class' => 'form-control',
                'placeholder' => 'Describa la bebida',
                'value' => set_value('producto_descripcion', $producto['producto_descripcion'] ?? '')
            ]) ?>
        </div>

        <div class="form-group">
            <label for="producto_precio">Precio</label>
            <?= form_input([
                'type' => 'number',
                'step' => '0.01',
                'min' => '0',
                'name' => 'producto_precio',
                'id' => 'producto_precio',
                'class' => 'form-control',
                'placeholder' => 'Ej: 1500.00',
                'value' => set_value('producto_precio', $producto['producto_precio'] ?? '')
            ]) ?>
        </div>

        <div class="form-group">
            <label for="producto_stock">Stock</label>
            <?= form_input([
                'type' => 'number',
                'min' => '0',
                'name' => 'producto_stock',
                'id' => 'producto_stock',
                'class' => 'form-control',
                'value' => set_value('producto_stock', $producto['producto_stock'] ?? '')
            ]) ?>
        </div>

        <div class="form-group">
            <label for="producto_volumen">Volumen (ml)</label>
            <?= form_input([
                'type' => 'number',
                'min' => '0',
                'name' => 'producto_volumen',
                'id' => 'producto_volumen',
                'class' => 'form-control',
                'value' => set_value('producto_volumen', $producto['producto_volumen'] ?? '')
            ]) ?>
        </div>

        <div class="form-group">
            <label for="producto_grado">Grado alcohólico (%)</label>
            <?= form_input([
                'type' => 'number',
                'step' => '0.1',
                'min' => '0',
                'max' => '100', 
                'name' => 'producto_grado',
                'id' => 'producto_grado',
                'class' => 'form-control',
                'value' => set_value('producto_grado', $producto['producto_grado'] ?? '')
            ]) ?>
        </div>

        <div class="form-group">
            <label for="producto_oferta">¿Está en oferta?</label>
                <?php
                    $oferta_opciones = [
                    ''  => 'Seleccione una opción',
                    '1' => 'Sí',
                    '0' => 'No'
                ];
                echo form_dropdown(
                'producto_oferta',
                $oferta_opciones,
                set_value('producto_oferta', $producto['producto_oferta'] ?? ''),
                'class="form-control" id="producto_oferta"'
                );
                ?>
        </div>

        <div class="form-group d-none" id="grupo_descuento">
            <label for="producto_descuento">Porcentaje de descuento (%)</label>
                <?= form_input([
                    'type' => 'number',
                    'min' => '1',
                    'max' => '100',
                    'step' => '1',
                    'name' => 'producto_descuento',
                    'id' => 'producto_descuento',
                    'class' => 'form-control',
                    'placeholder' => 'Ej: 20',
                    'value' => set_value('producto_descuento', $producto['producto_descuento'] ?? '')
                ]) ?>
        </div>

        <div class="form-group">
            <label for="producto_imagen">Imagen del producto</label>
            <?= form_upload([
                'name' => 'producto_imagen',
                'id' => 'producto_imagen'
            ]) ?>
            <?php if (isset($producto['producto_imagen'])): ?>
                <p>Imagen actual:</p>
                <img src="<?= base_url('assets/upload/' . $producto['producto_imagen']) ?>" width="150" class="mb-2">
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="marca_id">Marca</label>
            <?php
                $lista = ['' => 'Seleccione una marca'];
                foreach($marcas as $row){
                    $lista[$row['id_marca']] = $row['marca_nombre'];
                }
                echo form_dropdown('marca_id', $lista, set_value('marca_id', $producto['marca_id'] ?? ''), 'class="form-control" id="marca_id"');
            ?>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= $categoria['id_categoria'] ?>" <?= set_select('categoria_id', $categoria['id_categoria'], (isset($producto) && $producto['categoria_id'] == $categoria['id_categoria'])) ?>>
                        <?= esc($categoria['categoria_nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <?= form_submit('submit', isset($producto) ? 'Actualizar' : 'Agregar', "class='btn btn-success'") ?>
        </div>

        <?= form_close(); ?>
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectOferta = document.getElementById('producto_oferta');
    const grupoDescuento = document.getElementById('grupo_descuento');

    function toggleDescuento() {
        if (selectOferta.value === '1') {
            grupoDescuento.classList.remove('d-none');
        } else {
            grupoDescuento.classList.add('d-none');
        }
    }

    // Ejecutar al cargar
    toggleDescuento();

    // Ejecutar al cambiar
    selectOferta.addEventListener('change', toggleDescuento);
});
</script>
