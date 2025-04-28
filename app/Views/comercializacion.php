<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width= device-width, initial-scale = 1">
        <title>Comercialización</title>
        <link href = "assets/css/bootstrap.min.css" rel = "stylesheet" integrity ="" crossorigin ="">
        <script src = "assets/js/bootstrap.bundle.min.js" integrity ="" crossorigin =""></script>
        <link rel="stylesheet" href="/bushmillDrinks_asselborn_carbo/public/assets/css/estilos.css">
    </head>

    <body>
        <?php include('layout/navbar.php'); ?>
        <style>
            .map-container {
                position: relative;
                overflow: hidden;
                padding-top: 56.25%; /* Relación 16:9 */
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                margin-bottom: 30px;
            }

            .map-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: 0;
                }
        </style>

        <div class="container-md">
            <img src="assets/img/fondoComercializacion.jpg" alt="fondo comercializacion" srcset=""style="width: 100%; height: auto;">
        </div>


        <section>
            <h1 class= "secciones">
                PUNTOS DE VENTA
            </h1>
            <div class="container px-4 my-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.1081439305717!2d-58.841083899999994!3d-27.465892399999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456cbad0a12ad1%3A0x62fb44a34a5069be!2s9%20de%20Julio%20745%2C%20W3400AYN%20Corrientes!5e0!3m2!1ses-419!2sar!4v1745769056175!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <h5 class="text-center mt-2">9 de Julio 745</h5>
                    </div>

                    <div class="col-md-6">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.725862013062!2d-58.8323712!3d-27.477792699999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456c9c2987db37%3A0x64ded0a3000f1d5c!2sLavalle%201534%2C%20W3410BDE%20Corrientes!5e0!3m2!1ses-419!2sar!4v1745781938941!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <h5 class="text-center mt-2">Lavalle 1534</h5>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class= "secciones">
                MÉTODO DE ENVÍO
            </h2>
            <p class= "textoCentrado">
                Comunícate con <a class= "linkPersonalizado" href= "Contacto">nosotros</a> para realizar tu pedido y coordinar la entrega. Contamos con envío gratuito dentro de las 4 avenidas. 
            </p>
        </section>
        <?php include('layout/footer.php'); ?>
    </body>
</html>