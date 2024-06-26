<?php

/**
 * This file contains all the fields and settings
 * for products of Woocommerce
 * 
 */



if (!class_exists('Product_Highlights')) :

    class Product_Highlights
    {
        public function __construct()
        {
            add_action('add_meta_boxes', array($this, 'add_highlights_metabox'));
            add_action('save_post', array($this, 'save_highlights_metabox'));
        }

        public function add_highlights_metabox()
        {
            add_meta_box(
                'product_highlights',
                'Product Highlights',
                array($this, 'render_highlights_metabox'),
                'product',
                'normal',
                'high'
            );
        }

        public function render_highlights_metabox($post)
        {
            wp_nonce_field('save_highlights_metabox', 'highlights_nonce');

            $highlights = get_post_meta($post->ID, '_product_highlights', true);

            echo '<div id="product-highlights-container">';
            if (!empty($highlights)) {
                foreach ($highlights as $index => $highlight) {
                    $this->highlight_template($highlight, $index);
                }
            } else {
                $this->highlight_template();
            }
            echo '</div>';
            echo '<button type="button" id="add-highlight" class="button">Add Highlight</button>';

?>
            <script>
                jQuery(document).ready(function($) {
                    var index = <?php echo !empty($highlights) ? count($highlights) : 0; ?>;
                    $('#add-highlight').on('click', function() {
                        var template = `
                <div class="highlight">
                    <label for="highlight_title_${index}">Title</label>
                    <input type="text" id="highlight_title_${index}" name="product_highlights[${index}][title]" value="" class="widefat" />

                    <label for="highlight_description_${index}">Description</label>
                    <textarea id="highlight_description_${index}" name="product_highlights[${index}][description]" class="widefat"></textarea>

                    <button type="button" class="remove-highlight button">Remove</button>
                    <hr>
                </div>
                `;
                        $('#product-highlights-container').append(template);
                        index++;
                    });

                    $(document).on('click', '.remove-highlight', function() {
                        $(this).closest('.highlight').remove();
                    });
                });
            </script>
<?php
        }

        public function highlight_template($highlight = array(), $index = 0)
        {
            $title = isset($highlight['title']) ? $highlight['title'] : '';
            $description = isset($highlight['description']) ? $highlight['description'] : '';

            echo '<div class="highlight">';
            echo '<label for="highlight_title_' . $index . '">Title</label>';
            echo '<input type="text" id="highlight_title_' . $index . '" name="product_highlights[' . $index . '][title]" value="' . esc_attr($title) . '" class="widefat" />';

            echo '<label for="highlight_description_' . $index . '">Description</label>';
            echo '<textarea id="highlight_description_' . $index . '" name="product_highlights[' . $index . '][description]" class="widefat">' . esc_textarea($description) . '</textarea>';

            echo '<button type="button" class="remove-highlight button">Remove</button>';
            echo '<hr>';
            echo '</div>';
        }

        public function save_highlights_metabox($post_id)
        {
            if (!isset($_POST['highlights_nonce'])) {
                return;
            }

            if (!wp_verify_nonce($_POST['highlights_nonce'], 'save_highlights_metabox')) {
                return;
            }

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            if (!current_user_can('edit_post', $post_id)) {
                return;
            }

            if (isset($_POST['product_highlights'])) {
                $highlights = array_map(function ($highlight) {
                    return array(
                        'title' => sanitize_text_field($highlight['title']),
                        'description' => sanitize_textarea_field($highlight['description']),
                    );
                }, $_POST['product_highlights']);

                update_post_meta($post_id, '_product_highlights', $highlights);
            } else {
                delete_post_meta($post_id, '_product_highlights');
            }
        }
    }

    new Product_Highlights();

endif;
