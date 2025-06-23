<?php
function crearIdCategoria($nombre) {
    $id = strtolower($nombre);
    $id = preg_replace('/[^a-z0-9]+/', '-', $id);
    $id = trim($id, '-');
    return $id;
}

$agrupados = [];
foreach ($productos as $producto) {
    $agrupados[$producto['categoria_nombre']][] = $producto;
}
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">Nuestras Bebidas</h2>
    <?php if (session()->getFlashdata('error_stock')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error_stock') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('mensaje') ?>
                </div>
            <?php endif; ?>
    <div class="accordion" id="accordionCategorias">
        <?php
        $indice = 0;
        foreach ($agrupados as $categoria => $items):
            $id_categoria = crearIdCategoria($categoria);
            $id_collapse = 'collapse-' . $id_categoria;
        ?>
        <div class="accordion-item mb-3 border-0 shadow-sm" id="<?= $id_categoria ?>">
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
                                        <?php if ($producto['producto_oferta'] && $producto['producto_oferta_precio'] !== null): ?>
                                            <p class="card-text mb-2">
                                                <span class="text-muted text-decoration-line-through">$<?= number_format($producto['producto_precio'], 2, ',', '.') ?></span><br>
                                                <span class="fw-bold text-success">$<?= number_format($producto['producto_oferta_precio'], 2, ',', '.') ?></span>
                                            </p>
                                        <?php else: ?>
                                            <p class="card-text mb-2 fw-semibold">$<?= number_format($producto['producto_precio'], 2, ',', '.') ?></p>
                                        <?php endif; ?>

                                        <div class="d-flex justify-content-center">
                                            <a href="<?= base_url('detalle/' . $producto['id_producto']) ?>" class="btn btn-outline-dark mt-auto mx-2">Ver más</a>
                                            <?php if(session('perfil_id') == 2): ?>
                                                <?= form_open('agregar_carrito') ?>
                                                    <?= form_hidden('id', $producto['id_producto']) ?>
                                                    <?= form_hidden('nombre', $producto['producto_nombre']) ?>
                                                    <?= form_hidden('precio', $producto['producto_oferta'] && $producto['producto_oferta_precio'] !== null
                                                        ? $producto['producto_oferta_precio']
                                                        : $producto['producto_precio']) ?>
                                                    <?= form_submit('agregar', 'Agregar', "class='btn btn-success mx-2'") ?>
                                                    <?= form_hidden('precio', $producto) ?>
                                                <?= form_close() ?>
                                            <?php else: ?>
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Debe iniciar sesión!">
                                                    <button class="btn btn-success mx-2" type="button" disabled>Agregar</button>
                                                </span>
                                            <?php endif; ?>
                                        </div>
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

<script>
    // Popovers para los botones de agregar si no hay sesión
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    [...popoverTriggerList].forEach(el => new bootstrap.Popover(el));

    // Funcionalidad de scroll automático al hash
    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.substring(1);
        if (!hash) return;

        const targetItem = document.getElementById(hash);
        const collapseEl = document.getElementById('collapse-' + hash);

        if (!collapseEl || !targetItem) return;

        const buttonEl = targetItem.querySelector('.accordion-button');
        if (buttonEl) {
            buttonEl.classList.remove('collapsed');
            buttonEl.setAttribute('aria-expanded', 'true');
        }

        const collapse = new bootstrap.Collapse(collapseEl, { toggle: false });
        collapse.show();

        collapseEl.addEventListener('shown.bs.collapse', () => {
            targetItem.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
</script>



