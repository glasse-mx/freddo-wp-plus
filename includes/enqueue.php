<?php

function freddo_plus_enqueue_cb()
{
    // SwiperJS
    wp_enqueue_style('freddo-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '6.5.8');
    wp_enqueue_script('freddo-swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '6.5.8', true);

    // Fancybox 
    wp_enqueue_style('freddo-fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', [], null);
    wp_enqueue_script('freddo-fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', [], null, false);

    // Plugins basic and helpers
    wp_enqueue_style('freddo-plus-styles', FREDDO_WP_PLUS_URL . '/assets/css/styles.css', [], FREDDO_WP_PLUS_VERSION);
    wp_enqueue_script('freddo-plus-product-group', FREDDO_WP_PLUS_URL . '/assets/js/product-group.js', ['wp-blocks', 'wp-element'], FREDDO_WP_PLUS_VERSION, true);
    wp_enqueue_script('freddo-plus-helpers', FREDDO_WP_PLUS_URL . '/assets/js/helpers.js', [], FREDDO_WP_PLUS_VERSION, true);

    if (is_product()) {
        wp_enqueue_script('freddo-product-swiper-js', FREDDO_WP_PLUS_URL . 'assets/js/product-swiper.js', ['freddo-swiper-js', 'freddo-fancybox-js'], FREDDO_WP_PLUS_VERSION, true);
    }
}
