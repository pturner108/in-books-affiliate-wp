<?php
/**
 * Function helpers
 */

require_once IBA\INC_DIR . 'iba-functions.php';

/**
 * Dirty way of returning include contents
 *
 * @param string $template
 * @return string
 */
function return_include_once($template)
{
    ob_start();
    include_once $template;
    return ob_get_clean();
}
