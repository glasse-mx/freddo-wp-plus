<?php


function freddo_social_icons_cb()
{
    $options = get_option('freddo_options');
    ob_start();
?>
    <div class="social-icons">
        <?php if ($options['instagram']) : ?>
            <a href='<?= $options['instagram'] ?>' target='_blank' class='socialLink color-instagram'>
                <i class='fab fa-instagram'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['facebook']) : ?>
            <a href='<?= $options['facebook'] ?>' class='socialLink color-facebook'>
                <i class='fab fa-facebook'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['twitter']) : ?>
            <a href='<?= $options['twitter'] ?>' class='socialLink color-x-twitter'>
                <i class='fab fa-x-twitter'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['tiktok']) : ?>
            <a href="<?= $options['tiktok'] ?>" class='socialLink color-tiktok'>
                <i class='fab fa-tiktok'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['youtube']) : ?>
            <a href='<?= $options['youtube'] ?>' class='socialLink color-youtube'>
                <i class='fab fa-youtube'></i>
            </a>
        <?php endif; ?>

        <?php if ($options['whatsapp']) : ?>
            <a href='<?= $options['whatsapp'] ?>' class='socialLink color-whatsapp'>
                <i class='fab fa-whatsapp'></i>
            </a>
        <?php endif; ?>
    </div>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
