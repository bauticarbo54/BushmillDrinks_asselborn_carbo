<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width= device-width, initial-scale = 1">
        <title>Contacto</title>

        <link rel="stylesheet" href="/bushmillDrinks_asselborn_carbo/public/assets/css/estilos.css">
        <link href = "assets/css/bootstrap.min.css" rel = "stylesheet" integrity ="" crossorigin ="">
        <script src = "assets/js/bootstrap.bundle.min.js" integrity ="" crossorigin =""></script>
    </head>
    <body>

        <?php include('layout/navbar.php'); ?>

        <section style="margin-bottom: 50px">
            <div class="container-md">
                <img src="assets/img/fondoContacto.png" alt="fondo contactanos" srcset=""style="width: 100%; height: auto;">

            </div>   

            <div class="container">
                
                <div class="row">
                    
                    <div class="col" style="margin-top: 20px;"> 
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Tu nombre">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Direccion de Email</label>
                            <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Numero de telefono</label>
                            <input type="email" class="form-control" id="exampleFormControlInput3" placeholder="Ejemplo: 3794 123456">
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comentarios</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                        <p> Av. 3 de Abril 567, Corrientes Capital</p>
                    </div>
                </div>    
            </div>
        </section>


        <?php include('layout/footer.php'); ?>
        
    </body>
</html>