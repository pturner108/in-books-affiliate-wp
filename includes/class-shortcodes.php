<?php
namespace IBA;

/**
 * Class Shortcodes
 *
 * @since 1.0.0
 */
class Shortcodes {
    /**
     * Will store all shortcodes atts by key (without prefix `iba`)
     * @var array
     */
    protected static $_shortcodes = array();

    public static function init() {
        Product_Carousel::register();
    }

    public static function get_atts($key) {
        return self::$_shortcodes[$key];
    }
}

/**
 * Requiring all shortcode class
 */
require_once INC_DIR . 'shortcodes/class-product-carousel.php';
