<?php

function product_gallery_block_cb()
{
    global $product;

    $product_Img = $product->get_image_id();
    $attachment_ids = $product->get_gallery_image_ids();
    $galleryFull = [];

    array_push($galleryFull, wp_get_attachment_image_url($product_Img, 'full'));

    foreach ($attachment_ids as $attachment_id) {
        array_push($galleryFull, wp_get_attachment_image_url($attachment_id, 'full'));
    }

    ob_start();
?>
    <?php if (!empty($galleryFull[0])) : ?>
        <div class="product-gallery-block">
            <div class="swiper product-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($galleryFull as $item) : ?>
                        <div class="swiper-slide">
                            <img src="<?= $item ?>" alt="" data-fancybox="gallery">
                        </div>
                    <?php endforeach ?>
                </div>
                <?php if (count($galleryFull) > 1) : ?>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="product__no-gallery d-flex justify-content-center">
            <img src="<?= FREDDO_WP_PLUS_URL . 'assets/img/logo-initial.png' ?>" alt="Freddo">
        </div>
    <?php endif; ?>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
