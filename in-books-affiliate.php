<?php
/**
 * Plugin Name: Inbooks Affiliate
 * Version: 1.0.0
 * Author: Joshua Jacobs, josh@mandala-designs.com
 * Author URI: http://dharmaspring.com
 * Text Domain: inba
 * License: GPLv2 or later
 */

if (!defined("ABSPATH")) {
    exit;
}

define('INBA_DIR', plugin_dir_path(__FILE__));
define('INBA_INC_DIR', trailingslashit(INBA_DIR . 'includes'));
define('INBA_LIB_DIR', trailingslashit(INBA_INC_DIR . 'lib'));

require_once INBA_INC_DIR . 'class-inba-related-list-table.php';
require_once INBA_INC_DIR . 'class-inba-metaboxes.php';
require_once INBA_INC_DIR . 'functions.php';

if (!class_exists('WC_Dependencies')) {
    require_once INBA_DIR . 'woo-includes/class-wc-dependencies.php';
}

/**
 * WooCommerce is required for this plugin
 */
if (!WC_Dependencies::woocommerce_active_check()) {
    return;
}

/**
 * Class INBA
 *
 * @since 1.0.0
 */
final class INBA {
    protected static $_instance = null;

    protected function __construct() {
        /**
         * Keep engine flowing
         */
        INBA_Metaboxes::init();
    }

    public static function instance() {
        if (is_null(self::$_instance )) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}

INBA::instance();
