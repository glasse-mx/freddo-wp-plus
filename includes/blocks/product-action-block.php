<?php

function product_action_block_cb()
{
    global $product;
    ob_start();
    // echo print_r($product, true);
?>
    <div class='single-product-details__container'>
        <div class='topbar'>
            <?php if ($product->is_on_sale()) : ?>
                <span class='sale__badge'>Oferta</span>
            <?php endif; ?>
            <?php if (freddoIsNew($product->get_date_created()->date('Y-m-d'))) : ?>
                <span class='new__badge'>Nuevo</span>
            <?php endif; ?>
        </div>

        <h3 class='product-title'><?= get_the_title() ?></h3>

        <p class='product__description'>
            <?= the_excerpt() ?>
        </p>

        <div class='price__selector'>Precio</div>

        <div class='add-to-cart__container'>
            <input type='number' value='1' />
            <button>Añadir al carrito</button>
            <button>Hablar con un agente</button>
        </div>
    </div>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
