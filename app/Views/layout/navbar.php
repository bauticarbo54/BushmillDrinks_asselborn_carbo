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

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="inicio">
                    <img src="assets/img/Logo.png" alt="Bootstrap" width="50" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="nosotros">Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link" href="inicio#Ofertas">Ofertas</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoriasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Productos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categoriasDropdown">
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
                        <li class="nav-item"><a class="nav-link" href="comercializacion">Comercialización</a></li>
                        <li class="nav-item"><a class="nav-link" href="contacto">Contacto</a></li>
                        <li class="nav-item"><a class="nav-link" href="terminos">Términos y Condiciones</a></li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                        <button class="btn btn-outline-success me-2" type="submit">Buscar</button>
                    </form>
                    <div class="d-flex">
                        <a href="login" class="btn btn-outline-secondary me-2" style="border-color: black; color: black;">Iniciar sesión</a>
                        <a href="registro" class="btn btn-dark">Registrarse</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Cartel de Promociones -->
        <div class="promo-banner">
            <div class="promo-text">
                🚚 Envío gratis en pedidos mayores a $20.000    |    🍻 2x1 en cervezas artesanales esta semana    |    🥃 10% de descuento abonando en efectivo o por transferencia 
            </div> 
        </div>
