<?php
namespace IBA;

/**
 * Class XocboxConfig
 *
 * @since 1.0.0
 */
class XocboxConfig {

    public static function init() {
        add_action('woocommerce_after_order_itemmeta', array(__CLASS__, 'availability_after_order_itemmeta'), 40, 3);
    }

    public static function availability_after_order_itemmeta($item_id, $item, $product) {

        echo 'here';

        $prod = (array) $product;
        if ($prod['variation_id']) {
            // echo "\nvar id  : ".$prod['variation_id'];
            $post = (array) $prod['parent'];
            // echo "\nprod id : ".$post['id'];
        } else {
            // echo "\nprod id : ".$prod['id'];
        }
        if ($prod['id']) {
            $xocbox_order_availability = get_post_meta($prod['id'], 'xocbox_order_availability', true);

            if (!$xocbox_order_availability) {
                $xocbox_order_availability = "unknown";
            }

            echo "<div><strong>AFTER item availability: $xocbox_order_availability<strong></div>";


            if($xocbox_order_availability == 'available'){
                echo "<div><strong style=\"color:#C93108\">item order status: shipped<strong> <span style=\"color:blue; display:none\">&nbsp;&nbsp;<a href=\"#\">[remove]</a></span></div>";
            }else{
                echo "<div><strong style=\"color:#C93108\">item order status: pending<strong> <span style=\"color:blue;\">&nbsp;&nbsp;<a href=\"#\">[remove]</a></span></div>";
            }

        }

    }

}

add_action('woocommerce_after_order_itemmeta',  'iba_test', 20, 4);

function iba_test() {
    echo "<h1>!!!!</h1>";
}


// Xocbox Item Availibility Hook(s) -- Cart, Checkout, Account Orders, Emails
add_filter ('xocbox_cart_item_name_extension','theme_xocbox_cart_item_name_extension',10,4);
function theme_xocbox_cart_item_name_extension ($title, $item, $item_key, $xocbox_order_availability) {
    return "<div><strong> NEW!!!!! *item availability: $xocbox_order_availability<strong></div>";
}
