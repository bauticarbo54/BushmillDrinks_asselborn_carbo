<?php $cart = \Config\Services::cart(); ?>

<h1 class="text-center">Carrito de compras</h1>
<a href="productos" class="btn btn-link" role="button">Seguir comprando</a>

<?php if ($cart->contents() == NULL) { ?>
    <h2 class="text-center alert alert-danger my-5">No tiene productos en el carrito!</h2>
<?php } else { ?>
    <table id="mytable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <td>Nº item</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Subtotal</td>
                <td>Acción</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $i = 1;
            foreach ($cart->contents() as $item) :
             ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['qty']; ?></td>
                <td><?php echo $item['subtotal']; $total = $total + $item['subtotal']; ?></td>
                <td><?php echo anchor('eliminar_item/'.$item['rowid'],'Eliminar'); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Total Compra: <?php echo $total; ?></td>
                <td>
                    <a href="<?php echo base_url('vaciar_carrito'); ?>" class="btn btn-success">Vaciar carrito</a>
                </td>
                <td>
                    <a href="ordenar_compra" class="btn btn-success" role="button">Ordenar compra</a>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>