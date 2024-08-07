<?php

function product_info_block_cb()
{
    global $product;
    $atributos = $product->get_attributes();
    $highlights = get_post_meta($product->get_id(), '_product_highlights', true);

    $cruzados = $product->get_cross_sell_ids();

    foreach ($cruzados as $cruzado) {
        $cruzado = wc_get_product($cruzado);
        if (has_term('reguladores', 'product_cat', $cruzado->get_id())) {
            $reguladorID[] = $cruzado->get_id();
        }
    }

    ob_start();
?>
    <div class="product-info-block">

        <?php if (has_term('maquinas', 'product_cat', $product->get_id())) : ?>
            <p style="margin-top: 1rem"><b style="color: #ff0000;">Advertencia:</b> La etiqueta del producto puede variar en referencia a la imagen mostrada. <b>FREDDO MEXICO</b> se reserva el derecho de cambiar la imagen del producto sin previo aviso. <b>FREDDO MEXICO NO VENDE FRANQUICIAS</b>, El uso de la etiqueta de la marca <b> NO ES OBLIGATORIO</b>, y puede usar su propia etiqueta si asi lo desea sin sufrir repercusiones</p>
        <?php endif; ?>

        <!-- Caracteristicas del producto -->
        <?php if (isset($highlights[0]) && $highlights[0]['title'] != '') : ?>
            <div class="highlights__container">
                <h3>Características</h3>
                <ul>
                    <?php foreach ($highlights as $highlight) : ?>
                        <li>
                            <span class="material-symbols-rounded">
                                new_releases
                            </span>
                            <p><b><?= $highlight['title'] ?></b></p>
                            <p><?= $highlight['description'] ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Ficha Tecnica -->
        <?php if (count($atributos) > 1) : ?>
            <div class="spechsheet__container">
                <h3><?= has_term('maquinas', 'product_cat', $product->get_id()) ? 'Ficha Técnica' : 'Información Nutricional' ?></h3>
                <div class="specstable">
                    <?php foreach ($atributos as $atributo) : ?>
                        <div class="spec">
                            <p><b><?= wc_attribute_label($atributo->get_name()) ?></b></p>
                            <p><?= $product->get_attribute($atributo->get_name()) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Informacion de Seguridad Block - Solo se presenta en los productos de tipo 'maquinas' -->
        <?php if (has_term('maquinas', 'product_cat', $product->get_id())) : ?>
            <div class="content__card">
                <div class="content__header">
                    <h3>Información de Seguridad</h3>
                    <i class="fa-solid fa-circle-chevron-up" type="button" data-bs-toggle="collapse" data-bs-target="#safetyInfo" aria-expanded="true" aria-controls="safetyInfo"></i>
                </div>
                <div class="collapse content__body show" id="safetyInfo">
                    <div class="info">
                        <div class="col">
                            <img src="<?= FREDDO_WP_PLUS_URL . '/assets/img/safety.png' ?>" alt="Diagrama de Instalacion electrica sugerido">

                        </div>
                        <div class="col">
                            <p>Debido a la variación repentina de corriente alterna en México, se recomienda el uso de Regulador de Voltaje Freddo. <b>Con la compra del regulador recomendado, tu garantía se extiende a partes eléctricas.</b> En caso de tener un voltaje alto, (por encima de 123V), la máquina marcará: “Error de alto voltaje en pantalla (UH)¨. Se debe tomar en cuenta que para operar una Máquina, es necesario cumplir con los requisitos para la conexión de electricidad. Debes tener una línea directa para la máquina y utilizar pastillas de 30 AMP (una bajada sólo para la máquina utilizando un cable calibre 8). Se recomienda el uso del siguiente diagrama de instalación eléctrica, para el correcto funcionamiento de la máquina.</p>

                            <?php if (!empty($reguladorID)) : $power = wc_get_product($reguladorID[0]) ?>
                                <div class="supply__card">
                                    <a href="<?= $power->get_permalink() ?>" class="card__header">
                                        <?php if (freddoIsNew($power->get_date_created()->date('Y-m-d'))) : ?>
                                            <span class="new__badge">Nuevo</span>
                                        <?php endif; ?>
                                        <?php if ($power->is_on_sale()) : ?>
                                            <span class="sale__badge">Oferta</span>
                                        <?php endif; ?>
                                        <?= $power->get_image() ?>

                                    </a>
                                    <div class="card__body">
                                        <div class="info">
                                            <h3 class="product__title"><?= $power->get_name(); ?></h3>
                                            <p><?= $power->get_short_description() ?></p>
                                        </div>

                                        <div class="price__holder">
                                            <?php if ($product->is_on_sale()) : ?> <p class="price-scratched">
                                                    <b>Precio de Lista:</b> <?= freddoPriceFormat($power->get_regular_price()); ?>
                                                </p>
                                                <p class="price sale-price">
                                                    <b>Precio de Oferta:</b> <?= freddoPriceFormat($power->get_sale_price()); ?>
                                                </p>
                                            <?php else : ?>
                                                <p class="price">
                                                    <b>Precio de Lista:</b> <?= freddoPriceFormat($power->get_regular_price()); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="footer">
                                            <a href=" <?= '?add-to-cart=' . $power->get_id() ?>" class="add_to_cart_button ajax_add_to_cart" rel="nofollow" rel="nofollow">
                                                <button>
                                                    Añadir al carrito
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Envios Block -->
        <div class="content__card">
            <div class="content__header">
                <h3>Envíos</h3>
                <i class="fa-solid fa-circle-chevron-up" type="button" data-bs-toggle="collapse" data-bs-target="#shippingInfo" aria-expanded="false" aria-controls="shippingInfo"></i>
            </div>
            <div class="collapse content__body" id="shippingInfo">
                <div class="info">
                    <div class="col">
                        <img src="<?= FREDDO_WP_PLUS_URL . '/assets/img/castores.png' ?>" alt="Logo de la paqueteria Castores">
                        <img src="<?= FREDDO_WP_PLUS_URL . '/assets/img/tresguerras.png' ?>" alt="Logo de la paqueteria Tres Guerras">
                    </div>
                    <div class="col">
                        <p style="line-height: 2;">Te ofrecemos de manera permanente <b>envío gratis a Punto Ocurre</b>. Brindamos este servicio a través de las paqueterías <b>¨Tres Guerras y Castores¨</b>, en el cual enviamos tu pedido a la sucursal más cercana, de las paqueterías ya mencionadas, para que puedas recogerlo ahí. <b>Te sugerimos contactar a un asesor de ventas y revisar la cobertura de este servicio en tu localidad.</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagos Block -->
        <div class="content__card">
            <div class="content__header">
                <h3>Pago</h3>
                <i class="fa-solid fa-circle-chevron-up" type="button" data-bs-toggle="collapse" data-bs-target="#paymentInfo" aria-expanded="false" aria-controls="paymentInfo"></i>
            </div>
            <div class="collapse content__body" id="paymentInfo">
                <div class="info">
                    <div class="col">
                        <img src="<?= FREDDO_WP_PLUS_URL . '/assets/img/Visa.png' ?>" alt="Logo de Visa">
                        <img src="<?= FREDDO_WP_PLUS_URL . '/assets/img/Master.png' ?>" alt="Logo MasterCard">
                    </div>
                    <div class="col">
                        <h4>Ponemos a tu disponibilidad diversos métodos de pagos como transferencias, tarjeta de débito o crédito, o una liga de Open Pay by BBVA .</h4>
                        <h4>A su vez, contamos con 3 o 6 meses sin intereses con las tarjetas participantes Visa y Mastercard.</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
