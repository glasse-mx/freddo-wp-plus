<?php

function freddo_basic_whatsapp_button_cb()
{
    $options = get_option('freddo_options');
    ob_start();
?>
    <a href="<?= 'https://api.whatsapp.com/send/?phone=' . $options['whatsapp'] . '&text=' . urlencode('Hola!, Vengo de tu sitio web freddo.com.mx y estoy interesado/a en saber mas información sobre tus productos.')  ?>" class="basic-whatsapp-button" target="_blank">
        Habla Con Nosotros
        <i class="fa-brands fa-whatsapp"></i>
    </a>
<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
