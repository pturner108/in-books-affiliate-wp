<?php
namespace IBA;

/**
 * Class Shortcodes
 *
 * @since 1.0.0
 */
class Shortcodes {
    /**
     * Will store all shortcodes atts by key
     * @var array
     */
    private static $atts_references = array();

    public static function init() {
        add_shortcode('iba_product_carousel', array(__CLASS__, 'product_carousel'));
    }

    /**
     * [iba_product_carousel category="cat1,cat2" max="20" skin="boxed", header="title"]
     * @param $atts array
     *      $atts['category'] string. Optional, single category slug or comma separated
     *      $atts['max'] string|Int. Optional, Max number of product slides
     *      $atts['skin'] string. Optional, Templates to use
     *      $atts['header'] string. Optional, Defaults to category name
     *
     * @return string;
     */
    public static function product_carousel($atts) {
        $a = shortcode_atts(array(
            'category' => 'featured-product',
            'max' => 20,
            'skin' => 'boxed',
            'header' => ''
        ), $atts);

        self::$atts_references['product_carousel'] = $a;

        include TEMPLATE_DIR . 'carousel-slider.php';
    }
}
