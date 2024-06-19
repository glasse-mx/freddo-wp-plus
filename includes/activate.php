<?php

function freddo_activate_plugin()
{
    if (version_compare(get_bloginfo('version'), '5.9', '<')) {
        wp_die(
            __('You must updated WordPress to use this plugin', 'freddo-plus')
        );
    }

    // Creamos Opciones para las RRSS
    $options = get_option('freddo_options');

    if (!$options) {
        add_option('freddo_options', [
            'phone1' => '',
            'phone2' => '',
            'phone3' => '',
            'instagram' => '',
            'facebook' => '',
            'twitter' => '',
            'tiktok' => '',
            'youtube' => '',
            'whatsapp' => '',
        ]);
    }
}
