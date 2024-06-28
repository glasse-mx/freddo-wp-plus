<?php

function product_action_block_cb()
{
    global $product;
    $options = get_option('glasse_options');
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

        <?php if ($product->is_in_stock()) : ?>

            <?php if ($product->is_type('variable')) : ?>
                <?php $variations = $product->get_available_variations(); ?>
                <div class="price__holder">
                    <p class="price_tag">
                        <b>Desde: </b><?= freddoPriceFormat(freddoGetMinPrice($product)); ?>
                    </p>
                </div>

                <div class='add-to-cart__container'>
                    <form class="variations_form cart" action="" method="post" enctype="multipart/form-data">

                        <div class="shop__quantity">
                            <input disabled type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                        </div>
                        <div class="shop__add-to-cart">
                            <button disabled class="woocommerce-variation-add-to-cart variations_button" type="submit">Agregar al Carrito</button>
                            <input type="hidden" name="add-to-cart" value="<?= the_ID(); ?>">
                            <input type="hidden" name="product_id" value="<?= the_ID(); ?>">
                            <input type="hidden" name="variation_id" value=0>
                        </div>

                    </form>

                    <a href="<?= 'https://api.whatsapp.com/send/?phone=' . $options['whatsapp'] . '&text=' . urlencode('Deseo información sobre la entrega de ' . $product->get_title() . ' que encontré en su sitio web') ?>" class="whatsappLink" target="_blank">
                        <button>hablar con un agente
                            <i class="fab fa-whatsapp"></i></button>
                    </a>
                </div>

                <div class="sabor__holder">
                    <p><b>Sabor: </b><span>Primero, seleccione un sabor para poder agregar al carrito</span></p>
                </div>

                <div class="sabor__selector">
                    <?php for ($i = 0; $i < count($variations); $i++) : $variation = $variations[$i]; ?>
                        <div class="selector__item">
                            <label>
                                <input type="radio" name="sabor" id="<?= $variation['variation_id'] ?>" value="<?= $variation['variation_id'] ?>" rel="nofollow" data-price="<?= get_post_meta($variation['variation_id'], '_sale_price', true) ? get_post_meta($variation['variation_id'], '_sale_price', true) : get_post_meta($variation['variation_id'], '_regular_price', true) ?>" data-sabor-name=<?= ($variation['attributes']['attribute_sabor']) ?> onclick="handleSetVariationSingle()" data-variation-id="<?= $variation['variation_id'] ?>">
                                <img src=" <?= freddoGetVariationIconURI($variation) ?>" alt="<?= $variation['attributes']['attribute_sabor'] ?>" data-sabor-name="">
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>


            <?php else : ?>
                <?php if ($product->is_on_sale()) : ?>
                    <div class="price__holder">
                        <p class="price_tag scratched">
                            <b>Precio Lista: </b><?= freddoPriceFormat($product->get_regular_price()); ?>
                        </p>
                        <p class="price_tag">
                            <b>Precio Oferta: </b><?= freddoPriceFormat($product->get_sale_price()); ?>
                        </p>
                    </div>
                <?php else : ?>
                    <div class="price__holder">
                        <p class="price_tag">
                            <b>Precio Lista: </b><?= freddoPriceFormat($product->get_regular_price()); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <div class='add-to-cart__container'>
                    <form class="cart" method="post" enctype="multipart/form-data" action="<?= the_permalink(); ?>">
                        <div class="shop__quantity">
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                        </div>
                        <div class="shop__add-to-cart">
                            <button class="single-add-to-cart" type="submit" name="add-to-cart" value="<?= the_ID() ?>">Agregar al Carrito</button>
                        </div>
                    </form>
                    <a href="<?= 'https://api.whatsapp.com/send/?phone=' . $options['whatsapp'] . '&text=' . urlencode('Deseo información sobre la entrega de ' . $product->get_title() . ' que encontré en su sitio web') ?>" class="whatsappLink" target="_blank">
                        <button>hablar con un agente
                            <i class="fab fa-whatsapp"></i></button>
                    </a>
                </div>
            <?php endif; ?>




        <?php else : ?>
            <div class="no__stock">
                <h3>Agotado</h3>
                <p>Este producto no está disponible en este momento</p>
            </div>
        <?php endif; ?>
    </div>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
