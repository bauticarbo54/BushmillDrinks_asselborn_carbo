<div class="container mt-4">
    <h1 class="text-center mb-4">Historial de Ventas</h1>

    <!-- Filtro por fechas -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="bi bi-funnel-fill me-2"></i>Filtrar por fechas</h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('listar_ventas') ?>" method="get" class="row g-3">
                <div class="col-md-5">
                    <label for="fecha_inicio" class="form-label">Fecha desde</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        <input type="text" class="form-control datepicker" id="fecha_inicio" name="fecha_inicio" 
                               value="<?= !empty($fechaInicio) ? date('d/m/Y', strtotime($fechaInicio)) : '' ?>" 
                               placeholder="Seleccione fecha" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="fecha_fin" class="form-label">Fecha hasta</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        <input type="text" class="form-control datepicker" id="fecha_fin" name="fecha_fin" 
                               value="<?= !empty($fechaFin) ? date('d/m/Y', strtotime($fechaFin)) : '' ?>" 
                               placeholder="Seleccione fecha" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i>Filtrar
                    </button>
                </div>
            </form>
            <?php if (!empty($fechaInicio) || !empty($fechaFin)): ?>
                <div class="mt-3">
                    <a href="<?= site_url('listar_ventas') ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i>Quitar filtros
                    </a>
                    <small class="text-muted ms-2">
                        Mostrando ventas 
                        <?= !empty($fechaInicio) ? 'desde ' . date('d/m/Y', strtotime($fechaInicio)) : '' ?>
                        <?= (!empty($fechaInicio) && !empty($fechaFin)) ? ' hasta ' : '' ?>
                        <?= !empty($fechaFin) ? date('d/m/Y', strtotime($fechaFin)) : '' ?>
                    </small>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($ventasAgrupadas)): ?>
    <?php else: ?>
        <div class="alert alert-info text-center py-4">
            <?php if (!empty($fechaInicio) || !empty($fechaFin)): ?>
                <i class="bi bi-info-circle-fill me-2"></i> No hay ventas registradas en el rango de fechas seleccionado.
            <?php else: ?>
                <i class="bi bi-info-circle-fill me-2"></i> No hay ventas registradas en el sistema.
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

    <?php if (!empty($ventasAgrupadas)): ?>
        <div class="accordion" id="ventasAccordion">
            <?php foreach ($ventasAgrupadas as $venta): ?>
                <div class="accordion-item mb-3 border rounded-3">
                    <h2 class="accordion-header" id="heading<?= $venta['id_venta'] ?>">
                        <button class="accordion-button collapsed py-3" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse<?= $venta['id_venta'] ?>" 
                                aria-expanded="false" 
                                aria-controls="collapse<?= $venta['id_venta'] ?>">
                            <div class="d-flex justify-content-between w-100 pe-3 align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-3">#<?= $venta['id_venta'] ?></span>
                                    <div>
                                        <h6 class="mb-0 fw-bold"><?= $venta['cliente_nombre'] ?></h6>
                                        <small class="text-muted"><?= date('d/m/Y', strtotime($venta['fecha'])) ?></small>
                                    </div>
                                </div>
                                <span class="badge bg-success fs-6">$<?= number_format($venta['total'], 2, ',', '.') ?></span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse<?= $venta['id_venta'] ?>" class="accordion-collapse collapse" 
                         aria-labelledby="heading<?= $venta['id_venta'] ?>" 
                         data-bs-parent="#ventasAccordion">
                        <div class="accordion-body pt-4">
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Información del Cliente</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><i class="bi bi-person-fill me-2"></i> <strong>Nombre:</strong> <?= esc($venta['cliente_nombre']) ?></p>
                                            <p><i class="bi bi-envelope-fill me-2"></i> <strong>Email:</strong> <?= esc($venta['cliente_email']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Dirección de Envío</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><i class="bi bi-geo-alt-fill me-2"></i> <strong>Dirección:</strong> <?= esc($venta['envio_direccion']) ?></p>
                                            <p><i class="bi bi-mailbox me-2"></i> <strong>Código Postal:</strong> <?= esc($venta['envio_codigo']) ?></p>
                                            <p><i class="bi bi-envelope me-2"></i> <strong>Email envío:</strong> <?= esc($venta['envio_mail']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h5 class="mb-3"><i class="bi bi-cart-check me-2"></i>Detalle de Productos</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50%">Producto</th>
                                            <th width="15%" class="text-center">Cantidad</th>
                                            <th width="15%" class="text-end">P. Unitario</th>
                                            <th width="20%" class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($venta['productos'] as $producto): ?>
                                            <tr>
                                                <td><?= esc($producto['nombre']) ?></td>
                                                <td class="text-center"><?= $producto['cantidad'] ?></td>
                                                <td class="text-end">$<?= number_format($producto['precio_unitario'], 2, ',', '.') ?></td>
                                                <td class="text-end">$<?= number_format($producto['subtotal'], 2, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="table-active fw-bold">
                                            <td colspan="3" class="text-end">TOTAL VENTA</td>
                                            <td class="text-end">$<?= number_format($venta['total'], 2, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle-fill me-2"></i> No hay ventas registradas en el sistema.
        </div>
    <?php endif; ?>
</div>

<!-- jQuery (requerido por Bootstrap Datepicker) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Datepicker JS y CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

<!-- Localización en español -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.es.min.js"></script>

<script>
$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        autoclose: true,
        todayHighlight: true
    });

    $('#fecha_inicio').datepicker().on('changeDate', function(e) {
        $('#fecha_fin').datepicker('setStartDate', e.date);
    });

    $('#fecha_fin').datepicker().on('changeDate', function(e) {
        $('#fecha_inicio').datepicker('setEndDate', e.date);
    });
});
</script>




