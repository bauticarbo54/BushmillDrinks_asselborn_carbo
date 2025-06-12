<?php if(session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
<?php endif; ?>

<section style="margin-bottom: 50px">
    <div class="container-md">
        <img src="assets/img/fondoContacto.png" alt="fondo contactanos" style="width: 100%; height: auto;">
    </div>   

    <div class="container">
        <form method="post" action="<?= base_url('form_consulta') ?>">
            <div class="row">
                <div class="col" style="margin-top: 20px;"> 
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="mensaje_nombre" placeholder="Tu nombre" required value="<?=set_value('mensaje_nombre')?>">
                        <?php if (isset($validation) && $validation->hasError('mensaje_nombre')): ?>
                            <small class="text-danger"><?= $validation->getError('mensaje_nombre') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Dirección de Email</label>
                        <input type="email" class="form-control" id="email" name="mensaje_mail" placeholder="nombre@ejemplo.com" required value="<?=set_value('mensaje_mail')?>">
                        <?php if (isset($validation) && $validation->hasError('mensaje_mail')): ?>
                            <small class="text-danger"><?= $validation->getError('mensaje_mail') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Número de teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="mensaje_telefono" placeholder="Ejemplo: 3794 123456" required value="<?=set_value('mensaje_telefono')?>">
                        <?php if (isset($validation) && $validation->hasError('mensaje_telefono')): ?>
                            <small class="text-danger"><?= $validation->getError('mensaje_telefono') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="consulta" class="form-label">Comentarios</label>
                        <textarea class="form-control" id="consulta" name="mensaje_consulta" rows="3" required value="<?=set_value('mensaje_consulta')?>"></textarea>
                        <?php if (isset($validation) && $validation->hasError('mensaje_consulta')): ?>
                            <small class="text-danger"><?= $validation->getError('mensaje_consulta') ?></small>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-secondary">Enviar</button>
                </div>

                <div class="col" style="margin-top: 20px;">
                    <p><strong>Email</strong></p>
                    <p>soporte@bushmill.com</p>
                    <p><strong>Teléfono</strong></p>
                    <p>+54 11 1234-5678</p>
                    <p><strong>Horario de atención</strong></p>
                    <p>Lunes a Viernes, de 17 a 00 hs</p>
                    <p><strong>Dirección</strong></p>
                    <p>9 de Julio 745, Corrientes Capital</p>
                    <p>Lavalle 1534, Corrientes Capital</p>
                </div>
            </div>
        </form>
    </div>
</section>

