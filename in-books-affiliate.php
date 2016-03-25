<?php
/**
 * Plugin Name: Inbooks Affiliate
 * Version: 1.0.0
 * Author: Joshua Jacobs, josh@mandala-designs.com, rahilwazir
 * Author URI: http://dharmaspring.com
 * Text Domain: inba
 * License: GPLv2 or later
 */

namespace IBA;

if (!defined("ABSPATH")) {
    exit;
}

define('IBA\DIR', plugin_dir_path(__FILE__));
define('IBA\INC_DIR', trailingslashit(DIR . 'includes'));
define('IBA\LIB_DIR', trailingslashit(INC_DIR . 'lib'));

/** @noinspection PhpIncludeInspection */
require_once INC_DIR . 'class-related-list-table.php';
/** @noinspection PhpIncludeInspection */
require_once INC_DIR . 'class-metaboxes.php';
/** @noinspection PhpIncludeInspection */
require_once INC_DIR . 'functions.php';

if (!class_exists('WC_Dependencies')) {
    /** @noinspection PhpIncludeInspection */
    require_once DIR . 'woo-includes/class-wc-dependencies.php';
}

/**
 * WooCommerce is required for this plugin
 */
/** @noinspection PhpUndefinedClassInspection */
if (!\WC_Dependencies::woocommerce_active_check()) {
    return;
}

/**
 * Class IBA\Main
 *
 * @since 1.0.0
 */
final class Main {
    protected static $_instance = null;

    protected function __construct() {
        /**
         * Keep engine flowing
         */
        Metaboxes::init();
    }

    public static function instance() {
        if (is_null(self::$_instance )) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}

Main::instance();
