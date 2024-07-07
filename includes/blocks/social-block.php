<?php


function freddo_social_icons_cb()
{
    $options = get_option('freddo_options');
    ob_start();
?>
    <div class="social-icons">
        <?php if ($options['instagram']) : ?>
            <a href='<?= $options['instagram'] ?>' target='_blank' class='socialLink color-instagram' target="_blank">
                <i class='fab fa-instagram'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['facebook']) : ?>
            <a href='<?= $options['facebook'] ?>' class='socialLink color-facebook' target="_blank">
                <i class='fab fa-facebook'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['twitter']) : ?>
            <a href='<?= $options['twitter'] ?>' class='socialLink color-x-twitter' target="_blank">
                <i class='fab fa-x-twitter'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['tiktok']) : ?>
            <a href="<?= $options['tiktok'] ?>" class='socialLink color-tiktok' target="_blank">
                <i class='fab fa-tiktok'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['youtube']) : ?>
            <a href='<?= $options['youtube'] ?>' class='socialLink color-youtube' target="_blank">
                <i class='fab fa-youtube'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['whatsapp']) : ?>
            <a href='<?= $options['whatsapp'] ? 'https://api.whatsapp.com/send/?phone=' . $options['whatsapp'] . '&text=' . urlencode('Hola!, Vengo de tu sitio web freddo.com.mx y estoy interesado/a en saber mas información sobre tus productos.') : '#'  ?>' class='socialLink color-whatsapp' target="_blank">
                <i class='fab fa-whatsapp'></i>
            </a>
        <?php endif; ?>
    </div>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
