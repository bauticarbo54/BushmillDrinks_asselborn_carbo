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