<?php
namespace IBA;

/**
 * Class Product
 * [iba_product sku="189161841651" layout="CTA" cta="Read More" url=""]
 *
 * @since 1.0.0
 */
class Product extends Shortcodes {

    /**
     * @param $atts array
     *      $atts['sku'] string|int. Required, To retrieve product based on the SKU
     *      $atts['layout'] string. Optional. Possible values are "minimal" (default), "cta", "full"
     *              minimal: shows only product image.
     *              cta: Shows product image and call to action button. When CTA layout, "cta" parameter can be provided
     *                   to override the default call to action text.
     *              full: Shows product image, product title and CTA button
     *      $atts['cta'] string. Optional, Text to display for the CTA button. Default to "LEARN MORE".
     *      $atts['url']: string. Optional, HREF to apply to product and CTA button. Default to product landing page.
     */
    public function __construct($atts) {
        echo self::configure($atts);
    }

    public static function register() {
        add_shortcode('iba_product', array(__CLASS__, 'configure'));
    }

    /**
     * @param $atts array
     * @return string
     */
    public static function configure($atts) {
        $props = shortcode_atts(array(
            'sku' => null,
            'layout' => 'minimal',
            'cta' => 'LEARN MORE',
            'url' => ''
        ), $atts);

        if (empty($props['sku'])) {
            return 'SKU is required';
        }

        $props['sku'] = (string) $props['sku'];
        $props['sku'] = str_replace(array(' ', '-'), '', $props['sku']);

        $product_ID = wc_get_product_id_by_sku($props['sku']);

        if (!$product_ID) {
            return 'Invalid SKU or not found';
        }

        $product = wc_get_product($product_ID);

        if (empty($props['url'])) {
            $props['url'] = get_permalink($product_ID);
        }

        $path_format = \IBA\TEMPLATE_DIR . "shortcodes/product/%s.php";
        $layout = sprintf($path_format, $props['layout']);

        if (!file_exists($layout)) {
            $props['layout'] = 'minimal';
        }

        self::$_shortcodes['product'] = array(
            'atts' => $props,
            'query' => $product
        );

        if (file_exists($layout)) {
            return return_include($layout);
        }

        return '';
    }
}
