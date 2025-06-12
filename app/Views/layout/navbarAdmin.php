<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width= device-width, initial-scale = 1">
        <title>Inicio</title>
    
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/estilos.css') ?>">
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
        
    </head>

    <body>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="inicio">
                    <img src="<?= base_url('assets/img/Logo.png') ?>" alt="Bootstrap" width="50" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('ver_consultas')?>">Ver Consultas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('listar_bebidas')?>">Listar Bebidas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('listar_ventas')?>">Listar Ventas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('agregar_bebida')?>">Agregar Bebidas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('gestionar_bebidas')?>">Gestionar Bebidas</a></li>
                        <li class="nav-item"><?php if (session()->has('usuario')): ?>
                                                <a class="nav-link"> <?= esc(session()->get('usuario')) ?></a>
                                            <?php endif; ?>
                        </li>
                    </ul>
                    <div class="d-flex gap-2">
                        <?php if (session()->get('modo_cliente')): ?>
                            <a href="<?= base_url('volverAModoAdmin') ?>" class="btn btn-warning">Volver a modo admin</a>
                        <?php else: ?>
                            <a href="<?= base_url('verComoCliente') ?>" class="btn btn-info">Ver como cliente</a>
                        <?php endif; ?>
    
                        <a href="<?= base_url('logout') ?>" class="btn btn-dark">Salir</a>
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