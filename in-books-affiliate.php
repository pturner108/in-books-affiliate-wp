<?php
/**
 * Plugin Name: Inbooks Affiliate
 * Version: 1.0.0
 * Author: Joshua Jacobs, josh@mandala-designs.com, rahilwazir
 * Author URI: http://dharmaspring.com
 * Text Domain: iba
 * License: GPLv2 or later
 */

namespace IBA;

if (!defined("ABSPATH")) {
    exit;
}

/**
 * Directory Paths
 */
define('IBA\DIR', plugin_dir_path(__FILE__));
define('IBA\INC_DIR', trailingslashit(DIR . 'includes'));
define('IBA\TEMPLATE_DIR', trailingslashit(DIR . 'templates'));
define('IBA\LIB_DIR', trailingslashit(INC_DIR . 'lib'));

/**
 * URI Paths
 */
define('IBA\URI', plugin_dir_url(__FILE__));
define('IBA\ASSETS_URI', trailingslashit(URI . 'assets'));


require_once INC_DIR . 'class-related-list-table.php';
require_once INC_DIR . 'class-metaboxes.php';
require_once INC_DIR . 'class-shortcodes.php';
require_once INC_DIR . 'class-acf.php';
require_once INC_DIR . 'class-post-types.php';
require_once INC_DIR . 'functions.php';
require_once INC_DIR . 'hooks.php';

if (!class_exists('WC_Dependencies')) {
    require_once DIR . 'woo-includes/class-wc-dependencies.php';
}

/**
 * WooCommerce is required for this plugin
 */
if (!\WC_Dependencies::woocommerce_active_check()) {
    return;
}

/**
 * Class Main
 *
 * @since 1.0.0
 */
final class Main {
    const VERSION = '1.0.0';

    protected static $_instance = null;

    protected function __construct() {
        /**
         * Keep engine flowing
         */
        $acf = new ACF(array(
            'acf_core_path' => LIB_DIR . 'advanced-custom-fields-pro/',
            'acf_core_path_url' => plugin_dir_url(__FILE__) . 'lib/advanced-custom-fields-pro/'
        ));
        $fields = include_once INC_DIR . 'data/acf-data.php';
        $acf->set_fields($fields)->register_fields();

        Metaboxes::init();
        Shortcodes::init();
    }

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}

Main::instance();
