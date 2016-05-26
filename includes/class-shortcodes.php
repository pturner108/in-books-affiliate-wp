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
     *      $atts['tag'] string. Optional, single product_tag slug or comma separated
     *      $atts['max'] string|Int. Optional, Max number of product slides
     *      $atts['skin'] string. Optional, Templates to use
     *      $atts['header'] string. Optional, Defaults to category name
     *      $atts['see_more_caption'] string. Optional, Defaults to 'View All' will point to target category page
     *
     * @return string;
     */
    public static function product_carousel($atts) {
        $props = shortcode_atts(array(
            'category' => '',
            'tag' => '',
            'max' => 20,
            'skin' => 'boxed',
            'header' => '',
            'see_more_caption' => 'View All'
        ), $atts);

        self::$atts_references['product_carousel'] = $props;

        include TEMPLATE_DIR . 'carousel-slider.php';
    }
}
