<?php

/**
 * Devuelve el número de teléfono formateado
 * 
 * @param string $telefono Número de teléfono sin formato
 * @return string Número de teléfono formateado
 * 
 */
function freddoPhoneNumber($telefono)
{
    // Eliminar cualquier caracter que no sea un número
    $telefono = preg_replace('/[^0-9]/', '', $telefono);

    // Verificar la longitud del número de teléfono
    if (strlen($telefono) == 10) {
        // Formatear como xx xxxx xxxx
        $telefonoFormateado = substr($telefono, 0, 2) . ' ' . substr($telefono, 2, 4) . ' ' . substr($telefono, 6, 4);
        return $telefonoFormateado;
    } else {
        // Si la longitud no es válida, devolver el número sin formato
        return $telefono;
    }
}

/**
 * Determina si el producto fue publicado en los últimos 30 días
 * 
 * @param string $date Fecha de publicación del producto
 * @return bool Verdadero si el producto es nuevo, falso en caso contrario
 */
function freddoIsNew($date)
{
    $today = new DateTime(); // Fecha actual
    $productDate = new DateTime($date);
    $diff = $today->diff($productDate); // Diferencia entre fechas
    $diffDays = $diff->days;

    if ($productDate > $today) {
        // Si la fecha del producto es futura, ajusta los días de diferencia
        $diffDays = -$diffDays;
    }

    return $diffDays <= 30;
}
/**
 * Formatea el precio de un producto en Pesos Mexicanos
 * 
 * @param float $price Precio del producto
 * @return string Precio formateado en Pesos Mexicanos
 */
function freddoPriceFormat($price)
{
    return number_format($price, 2, '.', ',') . ' MXN';
}

/**
 * Obtiene el precio mínimo de un producto variable
 * @param WC_Product $product
 * @return float
 */
function freddoGetMinPrice($product)
{
    if ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        $minPrice = $variations[0]['display_price'];
        foreach ($variations as $variation) {
            if ($variation['display_price'] < $minPrice) {
                $minPrice = $variation['display_price'];
            }
        }
        return $minPrice;
    } else {
        return $product->get_price();
    }
}

function freddoGetVariationIconURI($variation)
{
    switch ($variation['attributes']['attribute_sabor']) {
        case '"Vainilla"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/vanilla.webp';
            break;
        case '"Chocolate"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/chocolate.webp';
            break;
        case '"Fresa"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/strawberry.webp';
            break;
        case '"Taro"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/taro.webp';
            break;
        case '"Capuchino"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/coffee.webp';
        case '"Limon"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/lemon.webp';
        case '"Mango"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/mango.webp';
        case '"chamoy"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/chamoy.webp';
        case '"Frutos Rojos"':
            return FREDDO_WP_PLUS_URL . '/assets/img/flavors/redberries.webp';
        default:
            return false;
    }
}
