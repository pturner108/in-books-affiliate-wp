<?php
namespace IBA;

/**
 * Class XocboxConfig
 *
 * @since 1.0.0
 */
class XocboxConfig {

    public static function init() {
        add_filter( 'woocommerce_payment_successful_result', array(__CLASS__, 'woocommerce_payment_successful_result'), 10, 2);
    }


    /**
     * The Xocbox payment method neglects to clear the cart after successful processing. This filter clears the cart.
     *
     * @param $result
     * @param $order_id
     * @return mixed
     */
    public static function woocommerce_payment_successful_result($result, $order_id) {
        if ( isset( $result['result'] ) && 'success' === $result['result'] ) {
            WC()->cart->empty_cart();
        }
        return $result;
    }

}

