<h1 class = "text-center">Registro de Bebida</h1>
    <div class = "container">
        <div class = "w-50 mx-auto">
            <?php if (!empty($validation)): ?>
                <div class = "alert alert-danger" role = "alert">
                    <ul>
                        <?php foreach ($validation as $error): ?>
                            <li><?=esc($error)?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if(session('mensaje')){
                ?><div class = "alert alert-success">
                    <?= session('mensaje');?>
                </div>
            <?php } ?>

            <?php echo form_open_multipart('insertar_bebida') ?>
                <div class = "form-group">
                    <label for = "producto_nombre">Nombre de la bebida</label>
                    <?php echo form_input([
                        'name' => 'producto_nombre', 
                        'id' => 'producto_nombre', 
                        'class' => 'form-control', 
                        'placeholder' => 'Ingrese el nombre de la bebida', 
                        'value' => set_value('producto_nombre')
                        ]); ?>
                </div>

                <div class="form-group">
                    <label for="producto_descripcion">Descripción</label>
                    <?php echo form_textarea([
                        'name' => 'producto_descripcion',
                        'id' => 'producto_descripcion',
                        'class' => 'form-control',
                        'placeholder' => 'Describa la bebida',
                        'value' => set_value('producto_descripcion')
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="producto_precio">Precio</label>
                    <?php echo form_input([
                        'type' => 'number',
                        'step' => '0.01',
                        'name' => 'producto_precio',
                        'id' => 'producto_precio',
                        'class' => 'form-control',
                        'placeholder' => 'Ej: 1500.00',
                        'value' => set_value('producto_precio')
                    ]) ?>
                </div>

                 <div class="form-group">
                    <label for="producto_stock">Stock</label>
                    <?php echo form_input([
                        'type' => 'number',
                        'name' => 'producto_stock',
                        'id' => 'producto_stock',
                        'class' => 'form-control',
                        'value' => set_value('producto_stock')
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="producto_volumen">Volumen (ml)</label>
                    <?php echo form_input([
                        'type' => 'number',
                        'name' => 'producto_volumen',
                        'id' => 'producto_volumen',
                        'class' => 'form-control',
                        'value' => set_value('producto_volumen')
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="producto_grado">Grado alcohólico (%)</label>
                    <?php echo form_input([
                        'type' => 'number',
                        'step' => '0.1',
                        'name' => 'producto_grado',
                        'id' => 'producto_grado',
                        'class' => 'form-control',
                        'value' => set_value('producto_grado')
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="producto_imagen">Imagen del producto</label>
                    <?php echo form_upload([
                        'name' => 'producto_imagen',
                        'id' => 'producto_imagen',
                        'type' => 'file',
                        'value' =>set_value('producto_imagen')
                    ]) ?>
                </div>
                
                <div class="form-group">
                    <label for="marca_id">Marca</label>
                    <?php
                        $lista = ['' => 'Seleccione una marca'];
                        foreach($marcas as $row){
                        $lista[$row['id_marca']] = $row['marca_nombre'];
                        }
                        echo form_dropdown('marca_id', $lista, set_value('marca_id'), 'class="form-control" id="marca_id"');
                    ?>
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control">
                        <option value="">Seleccione una categoría</option>
                        <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?= $categoria['id_categoria'] ?>" <?= set_select('categoria_id', $categoria['id_categoria']) ?>>
                                <?= esc($categoria['categoria_nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class = "form-group mt-3">
                    <?php echo form_submit('Agregar', 'Agregar', "class = 'btn btn-success'"); ?>
                </div>
                
            <?php echo form_close(); ?>
        </div>
    </div>