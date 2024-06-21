<?php

function freddo_plus_enqueue_cb()
{
    wp_enqueue_style('freddo-plus-styles', FREDDO_WP_PLUS_URL . '/assets/css/styles.css', [], FREDDO_WP_PLUS_VERSION);
    wp_enqueue_script('freddo-plus-product-group', FREDDO_WP_PLUS_URL . '/assets/js/product-group.js', ['wp-blocks', 'wp-element'], FREDDO_WP_PLUS_VERSION, true);
}
