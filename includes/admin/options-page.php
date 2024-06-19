<?php

function freddo_plugin_option_page()
{
    $options = get_option('freddo_options');
?>
    <div class="wrap">
        <h1><?php esc_html_e('Ajuste de Contacto', 'freddo-plus'); ?></h1>

        <?php if (isset($_GET['status']) && $_GET['status'] == 1) { ?>
            <div class="notice notice-success">
                <p><?php esc_html_e('Options saved successfully', 'freddo-plus'); ?></p>
            </div>
        <?php } ?>

        <form novalidate="novalidate" method="POST" action="admin-post.php">
            <input type="hidden" name="action" value="freddo_save_options">
            <?php wp_nonce_field('freddo_options_verify'); ?>
            <table class="form-table">
                <tbody>
                    <!-- Phone Numbers -->
                    <tr>
                        <th>
                            <label for="freddo_phone1">
                                <?php esc_html_e('Telefono #1', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_phone1" type="text" id="freddo_phone1" class="regular-text" value="<?= esc_attr($options['phone1']) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="freddo_phone2">
                                <?php esc_html_e('Telefono #2', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_phone2" type="text" id="freddo_phone2" class="regular-text" value="<?= esc_attr($options['phone2']) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="freddo_phone3">
                                <?php esc_html_e('Telefono #3', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_phone3" type="text" id="freddo_phone3" class="regular-text" value="<?= esc_attr($options['phone3']) ?>" />
                        </td>
                    </tr>

                    <!-- Social Media -->
                    <tr>
                        <th>
                            <label for="freddo_instagram">
                                <?php esc_html_e('Instagram', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_instagram" type="text" id="freddo_instagram" class="regular-text" value="<?= esc_attr($options['instagram']) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="freddo_facebook">
                                <?php esc_html_e('Facebook', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_facebook" type="text" id="freddo_facebook" class="regular-text" value="<?= esc_attr($options['facebook']) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="freddo_twitter">
                                <?php esc_html_e('Twitter', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_twitter" type="text" id="freddo_twitter" class="regular-text" value="<?= esc_attr($options['twitter']) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="freddo_tiktok">
                                <?php esc_html_e('TikTok', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_tiktok" type="text" id="freddo_tiktok" class="regular-text" value="<?= esc_attr($options['tiktok']) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="freddo_youtube">
                                <?php esc_html_e('Youtube', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_youtube" type="text" id="freddo_youtube" class="regular-text" value="<?= esc_attr($options['youtube']) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="freddo_whatsapp">
                                <?php esc_html_e('Whatsapp', 'freddo-plus'); ?>
                            </label>
                        </th>
                        <td>
                            <input name="freddo_whatsapp" type="text" id="freddo_whatsapp" class="regular-text" value="<?= esc_attr($options['whatsapp']) ?>" />
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
        </form>
    <?php
}
