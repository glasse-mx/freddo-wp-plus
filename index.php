<?php

/**
 * Plugin Name:       Freddo WP Plus
 * Plugin URI:        https://gabecode.com
 * Description:       Agregamos bloques personalizados al sitio.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.2
 * Author:            Gabriel Coronado
 * Author URI:        https://gabecode.com
 * Text Domain:       freddo-plus
 * Domain Path:       /languages
 */

if (!function_exists('add_action')) {
    echo 'This is my spot - Sheldon Cooper. 😛';
    exit;
}

// Setup
define('FREDDO_WP_PLUS_DIR', plugin_dir_path(__FILE__));
define('FREDDO_WP_PLUS_URL', plugin_dir_url(__FILE__));
define('FREDDO_PLUGIN_FILE', __FILE__);
define('FREDDO_WP_PLUS_VERSION', '1.0.0');
// echo FREDDO_WP_PLUS_DIR;

// Includes
$rootFiles = glob(FREDDO_WP_PLUS_DIR . '/includes/*.php');
$subdirectoryFiles = glob(FREDDO_WP_PLUS_DIR . '/includes/**/*.php');
$allFiles = array_merge($rootFiles, $subdirectoryFiles);

foreach ($allFiles as $filename) {
    include_once($filename);
}

// Hooks
register_activation_hook(__FILE__, 'freddo_activate_plugin');
add_action('admin_menu', 'freddo_admin_menus');
add_action('admin_post_freddo_save_options', 'freddo_save_options_cb');

// Blocks
add_action('init', 'freddo_register_blocks');
