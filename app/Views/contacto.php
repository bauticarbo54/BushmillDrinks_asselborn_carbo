        <?php helper('form'); ?>

        <section style="margin-bottom: 50px">
            <div class="container-md">
                <img src="assets/img/fondoContacto.png" alt="fondo contactanos" srcset=""style="width: 100%; height: auto;">

            </div>   

            <div class="container">
                
                <?php echo form_open('form_contacto'); ?>
                <div class="row">
                    
                        <div class="col" style="margin-top: 20px;"> 
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                <input type="text" name="mensaje_nombre" class="form-control" id="exampleFormControlInput1" placeholder="Tu nombre">
                                <?php if (isset($validation['mensaje_nombre'])): ?>
                                    <div class="text-danger"><?= $validation['mensaje_nombre'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Direccion de Email</label>
                                <input type="email" name="mensaje_mail"class="form-control" id="exampleFormControlInput2" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Numero de telefono</label>
                                <input type="tel" name="mensaje_telefono"   class="form-control" id="exampleFormControlInput3" placeholder="Ejemplo: 3794 123456">
                            </div>
                            
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Comentarios</label>
                                <textarea class="form-control" name="mensaje_consulta" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-secondary">Enviar</button>
                        </div>
                    

                        <div class="col" style="margin-top: 20px;">
                            <p><strong>Email</strong></p>
                            <p>soporte@bushmill.com</p>
                            <p><strong>Teléfono</strong></p>
                            <p>+54 11 1234-5678</p>
                            <p><strong>Horario de atención</strong></p>
                            <p> Lunes a Viernes, de 17 a 00 hs</p>
                            <p><strong>Dirección</strong></p>
                            <p> 9 de Julio 745, Corrientes Capital</p>
                            <p> Lavalle 1534, Corrientes Capital</p>
                        </div>
                </div>
                <?php echo form_close(); ?>  
            </div>
        </section>
