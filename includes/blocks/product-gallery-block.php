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
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
