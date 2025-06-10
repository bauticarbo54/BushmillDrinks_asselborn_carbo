<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">Nuestras Bebidas</h2>

    <div class="accordion" id="accordionCategorias">
        <?php
        $agrupados = [];
        foreach ($productos as $producto) {
            $agrupados[$producto['categoria_nombre']][] = $producto;
        }
        $indice = 0;
        foreach ($agrupados as $categoria => $items):
            $id_collapse = 'collapse' . $indice;
        ?>
        <div class="accordion-item mb-3 border-0 shadow-sm">
            <h2 class="accordion-header" id="heading<?= $indice ?>">
                <button class="accordion-button <?= $indice > 0 ? 'collapsed' : '' ?> fw-semibold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $id_collapse ?>" aria-expanded="<?= $indice === 0 ? 'true' : 'false' ?>" aria-controls="<?= $id_collapse ?>">
                    <?= esc($categoria) ?>
                </button>
            </h2>
            <div id="<?= $id_collapse ?>" class="accordion-collapse collapse <?= $indice === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $indice ?>" data-bs-parent="#accordionCategorias">
                <div class="accordion-body bg-light rounded-bottom">
                    <div class="row">
                        <?php foreach ($items as $producto): ?>
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100 border-0 shadow-sm rounded-4">
                                    <img src="<?= base_url('assets/upload/' . $producto['producto_imagen']) ?>" class="card-img-top rounded-top-4" alt="<?= esc($producto['producto_nombre']) ?>" style="object-fit: cover; height: 200px;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-dark"><?= esc($producto['producto_nombre']) ?></h5>
                                        <p class="card-text mb-2 text-muted">$<?= esc($producto['producto_precio']) ?></p>
                                        <a href="<?= base_url('detalle/' . $producto['id_producto']) ?>" class="btn btn-outline-dark btn-sm mt-auto">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $indice++; endforeach; ?>
    </div>
</div>


