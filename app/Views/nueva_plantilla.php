<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width= device-width, initial-scale = 1">
        <title>Home</title>

        <link rel="stylesheet" href="/bushmillDrinks_asselborn_carbo/public/assets/css/estilos.css">
        <link href = "assets/css/bootstrap.min.css" rel = "stylesheet" integrity ="" crossorigin ="">
        <script src = "assets/js/bootstrap.bundle.min.js" integrity ="" crossorigin =""></script>
    </head>
    <body>
       <section>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src = "assets/img/Logo.png" alt = "Bootstrap" width="50" height="50">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Ofertas</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Categorias
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Whiskys</a></li>
                                    <li><a class="dropdown-item" href="#">Cervezas</a></li>
                                    <li><a class="dropdown-item" href="#">Vinos</a></li>
                                    <li><a class="dropdown-item" href="#">Aperitivos</a></li>
                                    <li><a class="dropdown-item" href="#">Espumantes</a></li>
                                    <li><a class="dropdown-item" href="#">Gins</a></li>
                                    <li><a class="dropdown-item" href="#">Vodkas</a></li>
                                    <li><a class="dropdown-item" href="#">Tekilas</a></li>
                                    <li><a class="dropdown-item" href="#">Sin alcohol</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Tabaco</a></li>
                                    <li><a class="dropdown-item" href="#">Accesorios</a></li>
                                    <li><a class="dropdown-item" href="#">Cristalería</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Comercialización</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Términos y Usos</a>
                            </li>
                            <li class = "nav-item">
                                <a class = "nav-link" href = "#">Contactos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true"></a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </section>

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
                    <img src="assets/img/Habano.jpg" class="d-block w-100" alt="...">
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