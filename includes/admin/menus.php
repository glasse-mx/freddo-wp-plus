<?php

function freddo_admin_menus()
{
    add_menu_page(
        __('Freddo Configuraciones', 'freddo_plus'),
        __('Freddo Configuraciones', 'freddo_plus'),
        'edit_theme_options',
        'freddo-plus-options',
        'freddo_plugin_option_page',
        plugins_url('icon.svg', FREDDO_PLUGIN_FILE)
    );
}
