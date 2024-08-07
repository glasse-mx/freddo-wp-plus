<?php

function freddo_register_blocks()
{
    $blocks = [
        ['name' => 'social-block', 'options' => [
            'render_callback' => 'freddo_social_icons_cb'
        ]],
        ['name' => 'phones-block', 'options' => [
            'render_callback' => 'freddo_phones_block_cb'
        ]],
        ['name' => 'ws-button-navbar', 'options' => [
            'render_callback' => 'freddo_ws_button_navbar_cb'
        ]],
        ['name' => 'location-navbar'],
        ['name' => 'products-group-block', 'options' => [
            'render_callback' => 'freddo_products_group_cb'
        ]],
        ["name" => 'menu-card-group'],
        ['name' => 'menu-card'],
        ['name' => 'product-action-block', 'options' => [
            'render_callback' => 'product_action_block_cb'
        ]],
        ['name' => 'product-info-block', 'options' => [
            'render_callback' => 'product_info_block_cb'
        ]],
        ['name' => 'product-gallery-block', 'options' => [
            'render_callback' => 'product_gallery_block_cb'
        ]],
        ['name' => 'related-products-block', 'options' => [
            'render_callback' => 'related_products_block_cb'
        ]],
        ['name' => 'basic-whatsapp-button', 'options' => [
            'render_callback' => 'freddo_basic_whatsapp_button_cb'
        ]],
        ['name' => 'spesc-carousel'],
        ['name' => 'spec-carousel-card']
    ];

    foreach ($blocks as $block) {
        register_block_type(
            FREDDO_WP_PLUS_DIR . 'build/blocks/' . $block['name'],
            isset($block['options']) ? $block['options'] : []
        );
    }
}
