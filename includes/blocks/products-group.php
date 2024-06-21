<?php

function freddo_products_group_cb($atts)
{
    $args = $atts['featured'] ? (
        [
            'post_type' => 'product',
            'posts_per_page' => 8, // Obtener todos los productos destacados (-1)
            'featured' => true, // Filtrar productos destacados
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_key' => '_' . $atts['orderBy'],
        ]
    ) : (
        [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'orderby' => $atts['orderBy'],
            'order' => $atts['order'] === 'asc' ? 'ASC' : 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $atts['cats'], // Reemplaza con los IDs de las categorías que deseas buscar
                    'operator' => 'IN',
                ),
            ),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                ),
                array(
                    'key' => '_stock_status',
                    'value' => 'instock',
                    'compare' => '='
                )
            ),
            // 'meta_key' => '_' . $atts['orderBy'],
        ]
    );

    $products = new WP_Query($args);
    ob_start();
?>
    <?php if ($products->have_posts()) : ?>
        <div class="<?= 'products-group-block cols-' . $atts['columns'] ?>">
            <?php while ($products->have_posts()) : $products->the_post();
                global $product; ?>
                <div class="product__card" id="<?= 'product-' . get_the_ID() ?>">
                    <div class="card__header">
                        <?php if (freddoIsNew($product->get_date_created()->date('Y-m-d'))) : ?>
                            <span class="new__badge">Nuevo</span>
                        <?php endif; ?>
                        <?php if ($product->is_on_sale()) : ?>
                            <span class="sale__badge">Oferta</span>
                        <?php endif; ?>
                        <img src="<?= has_post_thumbnail() ? the_post_thumbnail_url() : FREDDO_WP_PLUS_URL . '/assets/img/logo-initial.png' ?>" alt="<?= 'Imagen de ' . the_title() ?>">
                    </div>

                    <div class="card__body">
                        <div class="info">
                            <?php if ($atts['showTitle']) : ?>
                                <h3 class="product__title"><?= the_title(); ?></h3>
                            <?php endif; ?>

                            <?php if ($atts['showDesc']) : ?>
                                <p class="product__description"><?= the_excerpt(); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if ($atts['showPrice']) : ?>
                            <?php if ($product->is_type('variable')) : $variations = $product->get_available_variations(); ?>
                                <p class="sabor-holder">Sabor: <span class="var__name">Seleccione un Sabor</span></p>
                                <p class="price__var">
                                    <b>Desde: </b> <span><?= freddoPriceFormat(freddoGetMinPrice($product)); ?></span>
                                </p>
                                <div class="variations__display">
                                    <?php for ($i = 0; $i < min(count($variations), 5); $i++) : $variation = $variations[$i]; ?>
                                        <div class="selector__item">
                                            <label>
                                                <input onclick="handleSetVariation(<?= get_the_ID() ?>)" type="radio" name="sabor" id="<?= $variation['variation_id'] ?>" value="<?= $variation['variation_id'] ?>" rel="nofollow" data-sabor-name=<?= ($variation['attributes']['attribute_sabor']) ?> data-price="<?= get_post_meta($variation['variation_id'], '_sale_price', true) ? get_post_meta($variation['variation_id'], '_sale_price', true) : get_post_meta($variation['variation_id'], '_regular_price', true) ?>">
                                                <img class="color" src=" <?= $variation['image']['url'] ?>" alt="<?= $variation['attributes']['attribute_sabor'] ?>" data-sabor-name="">
                                                <span><?= $variation['attributes']['attribute_sabor'] ?></span>

                                            </label>
                                        </div>
                                    <?php endfor; ?>
                                    <?php if (count($variations) > 5) : ?>
                                        <div class="selector__item">
                                            <a href="<?= the_permalink(); ?>" class="show-more-variations">+<?= count($variations) - 5 ?></a>
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
