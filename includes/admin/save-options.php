<?php

function freddo_save_options_cb()
{
    if (!current_user_can('edit_theme_options')) {
        wp_die(__('You are not allowed to access this page.', 'freddo-plus'));
    }

    check_admin_referer('freddo_options_verify');

    $options = get_option('freddo_options');
    $options['phone1'] = sanitize_text_field($_POST['freddo_phone1']);
    $options['phone2'] = sanitize_text_field($_POST['freddo_phone2']);
    $options['phone3'] = sanitize_text_field($_POST['freddo_phone3']);
    $options['instagram'] = sanitize_text_field($_POST['freddo_instagram']);
    $options['facebook'] = sanitize_text_field($_POST['freddo_facebook']);
    $options['twitter'] = sanitize_text_field($_POST['freddo_twitter']);
    $options['tiktok'] = sanitize_text_field($_POST['freddo_tiktok']);
    $options['youtube'] = sanitize_text_field($_POST['freddo_youtube']);
    $options['whatsapp'] = sanitize_text_field($_POST['freddo_whatsapp']);

    update_option('freddo_options', $options);

    wp_redirect(admin_url('admin.php?page=freddo-plus-options&status=1'));
}
