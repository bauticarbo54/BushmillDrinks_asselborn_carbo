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
                        <img src="assets/img/Whiskys.jpeg" class="d-block w-100" alt="...">
                    </div>
                <div class="carousel-item">
                    <img src="assets/img/Vinos.jpeg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/Cerveza.jpeg" class="d-block w-100" alt="...">
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

        <div class="container py-5">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Bienvenidos a BushmillsDrinks, tu tienda online de bebidas favorita.</h3>
                    <p class="lead mt-4 fs-6">
                    En nuestro sitio encontrarás una amplia variedad de licores, vinos, cervezas y destilados de las mejores marcas (y aquellas no tan buenas), ideales para cada ocasión. Ya sea que busques el trago perfecto para una celebración, una reunión o simplemente disfrutar de un buen momento, tenemos lo que necesitas.
                    </p>
                </div>
            </div>
        </div>

    <section class="border border-5 p-5" id= "Ofertas">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <h1 class="text-center text-dark fw-bold" style="font-family: 'Bebas Neue', sans-serif;">
        OFERTAS
    </h1>
        <div class="card-group">
            <div class="card">
                <img src="assets/img/Heineken.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Cerveza Heineken 355cc x6</h5>
                        <p class="card-text">El suave y único sabor de la Heineken original. Elaborada con ingredientes naturales como 100% malta europea, agua y lúpulo. Su presentación es perfecta para disfrutarla fría.</p>
                        <p class="card-text"><small class="text-body-secondary">$8990,45</small></p>
                    </div>
            </div>
            <div class="card">
                <img src="assets/img/LuigiBoscaReserva.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Luigi Bosca Cabernet Sauvignon 750cc</h5>
                    <p class="card-text">Tinto de color rojo rubí profundo y brillante. Sus aromas son sutiles y equi­librados, con notas de frutos negros, especias y cuero. En boca es jugoso y expresivo, con taninos finos y firmes que se agarran.</p>
                    <p class="card-text"><small class="text-body-secondary">$97855,32</small></p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/BlackLabel.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Johnnie Walker Black Label 750cc</h5>
                        <p class="card-text">Mezclado exclusivamente con whiskies madurados por al menos 12 años, reúne sabores de los 4 rincones de Escocia para crear una experiencia compleja, profunda y enriquecedora. El final es increíblemente suave y equilibrado, rico en humo, turba y malta.</p>
                        <p class="card-text"><small class="text-body-secondary">$65800,00</small></p>
                    </div>
            </div>
        </div>
    </section>

        <?php include('layout/footer.php'); ?>
    </body>
</html>