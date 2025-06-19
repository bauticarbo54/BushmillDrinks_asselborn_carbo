<h1 class="text-center">Datos de envio</h1>
<a href="ver_carrito" class="btn btn-success" role="button">Volver al carrito</a>

<div class="container">
        <form method="post" action="<?= base_url('confirmar_compra') ?>">
            <div class="row">
                <div class="col" style="margin-top: 20px;"> 
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Número de teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="envio_telefono" placeholder="Ejemplo: 3794 123456" required value="<?=set_value('envio_telefono')?>">
                        <?php if (isset($validation) && $validation->hasError('envio_telefono')): ?>
                            <small class="text-danger"><?= $validation->getError('envio_telefono') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Dirección de Email</label>
                        <input type="email" class="form-control" id="email" name="envio_mail" placeholder="nombre@ejemplo.com" required value="<?=set_value('envio_mail')?>">
                        <?php if (isset($validation) && $validation->hasError('envio_mail')): ?>
                            <small class="text-danger"><?= $validation->getError('envio_mail') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia</label>
                        <select name="envio_provincia" id="provincia" class="form-select" required>
                            <option value="">-- Selecciona una provincia --</option>
                            <option value="">-- Selecciona una provincia --</option>
                            <option value="Buenos Aires">Buenos Aires</option>
                            <option value="Catamarca">Catamarca</option>
                            <option value="Chaco">Chaco</option>
                            <option value="Chubut">Chubut</option>
                            <option value="Córdoba">Córdoba</option>
                            <option value="Corrientes">Corrientes</option>
                            <option value="Entre Ríos">Entre Ríos</option>
                            <option value="Formosa">Formosa</option>
                            <option value="Jujuy">Jujuy</option>
                            <option value="La Pampa">La Pampa</option>
                            <option value="La Rioja">La Rioja</option>
                            <option value="Mendoza">Mendoza</option>
                            <option value="Misiones">Misiones</option>
                            <option value="Neuquén">Neuquén</option>
                            <option value="Río Negro">Río Negro</option>
                            <option value="Salta">Salta</option>
                            <option value="San Juan">San Juan</option>
                            <option value="San Luis">San Luis</option>
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="Santa Fe">Santa Fe</option>
                            <option value="Santiago del Estero">Santiago del Estero</option>
                            <option value="Tierra del Fuego">Tierra del Fuego</option>
                            <option value="Tucumán">Tucumán</option>
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="envio_ciudad" placeholder="Nombre de tu ciudad" required value="<?=set_value('envio_ciudad')?>">
                        <?php if (isset($validation) && $validation->hasError('envio_ciudad')): ?>
                            <small class="text-danger"><?= $validation->getError('envio_ciudad') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Codigo Postal</label>
                        <input type="number" class="form-control" id="codigo" name="envio_codigo" placeholder="Codigo postal de tu localidad" required value="<?=set_value('envio_codigo')?>">
                        <?php if (isset($validation) && $validation->hasError('envio_codigo')): ?>
                            <small class="text-danger"><?= $validation->getError('envio_codigo') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion de Entrega</label>
                        <input type="text" class="form-control" id="direccion" name="envio_direccion" placeholder="Nombre y numero de la calle" required value="<?=set_value('envio_direccion')?>">
                        <?php if (isset($validation) && $validation->hasError('envio_direccion')): ?>
                            <small class="text-danger"><?= $validation->getError('envio_direccion') ?></small>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-secondary">Enviar</button>
                </div>
            </div>
        </form>
</div>