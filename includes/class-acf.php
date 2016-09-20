<?php
namespace IBA;

if (!class_exists('IBA\ACF')) {
    /**
     * Class ACF
     *
     * @since 1.0.0
     */
    class ACF {
        /**
         * Array of acf fields
         *
         * @var array
         */
        private $fields = array();

        /**
         * Path to acf core
         *
         * @var string
         */
        private $settings = array(
            'acf_core_path' => '', //required
            'acf_core_path_url' => '' //required
        );

        public function __construct($settings = array())
        {
            if (!isset($settings['acf_core_path']) || empty($settings['acf_core_path'])) {
                throw new \Exception('Option {acf_core_path} is required');
            }

            if (!isset($settings['acf_core_path_url']) || empty($settings['acf_core_path_url'])) {
                throw new \Exception('Option {acf_core_path_url} is required');
            }

            $this->settings = $settings;

            $this->_load_acf_core();

            /**
             * Show options page
             */
            acf_add_options_page();

            self::show_acf_menu(false);
        }

        /**
         * Hide ACF Menu
         *
         * @param bool $bool . Optional
         * @return void
         */
        public static function show_acf_menu($bool = true)
        {
            add_filter('acf/settings/show_admin', '__return_' . ($bool ? 'true' : 'false'));
        }

        /**
         * @return array
         */
        public function get_fields()
        {
            return $this->fields;
        }

        /**
         * @param array $fields
         * @return $this
         */
        public function set_fields($fields = array())
        {
            $this->fields = $fields;
            return $this;
        }

        /**
         * Register acf fields
         *
         * @return void
         */
        public function register_fields()
        {
            $fields = $this->fields;

            if (is_array($fields)) {
                foreach ($fields as $field) {
                    acf_add_local_field_group($field);
                }
            }
        }

        /**
         * Check if ACF is used with another plugin, if not already called, use this one
         *
         * @return void
         * @throws
         */
        private function _load_acf_core()
        {
            if (class_exists('acf') && acf_get_setting('version') < '5') {
                throw new \Exception('ACF 5.x is required, please either upgrade or disable your existing plugin.');
            }

            if (!defined('ACF_LITE')) {
                define('ACF_LITE', true);
            }

            add_filter('acf/settings/path', function () {
                return $this->settings['acf_core_path'];
            });

            add_filter('acf/settings/dir', function () {
                return $this->settings['acf_core_path_url'];
            });

            include_once $this->settings['acf_core_path'] . 'acf.php';
        }
    }
}
