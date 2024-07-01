<?php

function related_products_block_cb()
{
    global $product;
    $related_ids = wc_get_related_products($product->get_id(), 4);
    $args = [
        'post_type' => 'product',
        'posts_per_page' => 4,
        'post__in' => $related_ids,
        'orderby' => 'post__in'
    ];

    $products = new WP_Query($args);

    ob_start();
?>
    <?php if ($products->have_posts()) : ?>
        <div class="related-products-group-block">
            <?php while ($products->have_posts()) : $products->the_post();
                global $product; ?>
                <div class="product__card" id="<?= 'product-' . get_the_ID() ?>">
                    <a href="<?= the_permalink() ?>" class="card__header">
                        <?php if (freddoIsNew($product->get_date_created()->date('Y-m-d'))) : ?>
                            <span class="new__badge">Nuevo</span>
                        <?php endif; ?>
                        <?php if ($product->is_on_sale()) : ?>
                            <span class="sale__badge">Oferta</span>
                        <?php endif; ?>
                        <img src="<?= has_post_thumbnail() ? the_post_thumbnail_url() : FREDDO_WP_PLUS_URL . '/assets/img/logo-initial.png' ?>" alt="<?= 'Imagen de ' . the_title() ?>">
                    </a>

                    <div class="card__body">
                        <div class="info">
                            <h3 class="product__title"><?= the_title(); ?></h3>
                        </div>

                        <?php if ($product->is_type('variable')) : $variations = $product->get_available_variations(); ?>
                            <p class="sabor-holder">Sabor: <span class="var__name">Seleccione un Sabor</span></p>
                            <p class="price__var">
                                <b>Desde: </b> <span><?= freddoPriceFormat(freddoGetMinPrice($product)); ?></span>
                            </p>
                            <div class="variations__display">
                                <?php for ($i = 0; $i < min(count($variations), 4); $i++) : $variation = $variations[$i]; ?>
                                    <div class="selector__item">
                                        <label>
                                            <input onclick="handleSetVariation(<?= get_the_ID() ?>)" type="radio" name="sabor" id="<?= $variation['variation_id'] ?>" value="<?= $variation['variation_id'] ?>" rel="nofollow" data-sabor-name=<?= ($variation['attributes']['attribute_sabor']) ?> data-price="<?= get_post_meta($variation['variation_id'], '_sale_price', true) ? get_post_meta($variation['variation_id'], '_sale_price', true) : get_post_meta($variation['variation_id'], '_regular_price', true) ?>">
                                            <img class="color" src=" <?= freddoGetVariationIconURI($variation) ?>" alt="<?= $variation['attributes']['attribute_sabor'] ?>" data-sabor-name="">
                                            <span><?= $variation['attributes']['attribute_sabor'] ?></span>

                                        </label>
                                    </div>
                                <?php endfor; ?>
                                <?php if (count($variations) > 4) : ?>
                                    <div class="selector__item">
                                        <a href="<?= the_permalink(); ?>" class="show-more-variations">+<?= count($variations) - 4 ?></a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php else : ?>
                            <div class="price__holder">
                                <?php if ($product->is_on_sale()) : ?>
                                    <p class="price-scratched">
                                        <b>Precio de Lista:</b> <?= freddoPriceFormat($product->get_regular_price()); ?>
                                    </p>
                                    <p class="price sale-price">
                                        <b>Precio de Oferta:</b> <?= freddoPriceFormat($product->get_sale_price()); ?>
                                    </p>
                                <?php else : ?>
                                    <p class="price">
                                        <b>Precio de Lista:</b> <?= freddoPriceFormat($product->get_regular_price()); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>


                        <?php if (has_term('maquinas', 'product_cat', $product->get_id())) : ?>
                            <p class="product__description" style="font-size: 12px;">Extiende tu garantía por un año a partes eléctricas con la compra del regulador.</p>
                        <?php endif; ?>

                        <div class="footer">
                            <a href="<?= the_permalink(); ?>">
                                <button>Ver Detalles</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <div class="no_products_found">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <h3>No se pueden mostrar productos</h3>
            <p>Revise sus criterios de busqueda e intente nuevamente</p>
        </div>
    <?php endif; ?>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
