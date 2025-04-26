<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width= device-width, initial-scale = 1">
        <title>Inicio</title>

        <link rel="stylesheet" href="/bushmillDrinks_asselborn_carbo/public/assets/css/estilos.css">
        <link href = "assets/css/bootstrap.min.css" rel = "stylesheet" integrity ="" crossorigin ="">
        <script src = "assets/js/bootstrap.bundle.min.js" integrity ="" crossorigin =""></script>
    </head>
    <body>
        <?php include('layout/navbar.php'); ?>

        <section>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/Whisky.png" class="d-block w-100" alt="...">
                    </div>
                <div class="carousel-item">
                    <img src="assets/img/Vino.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/Cervezas.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-container">
                    <p class="footer-text">© 2025 Bushmills Drinks. Todos los derechos reservados.</p>
                    <div class="footer-links">
                        <a href="https://github.com/tu_usuario" target="_blank">GitHub</a>
                        <a href="https://linkedin.com/in/tu_usuario" target="_blank">LinkedIn</a>
                        <a href="/contacto">Contacto</a>
                    </div>
            </div>
        </footer>
    </body>
</html>