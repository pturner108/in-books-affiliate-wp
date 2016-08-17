<?php
$options = iba_get_shortcodes_atts('product');
/**
 * @var WC_Product $product
 */
$product = $options['query'];
?>

<div class="iba-product layout-<?php echo $options['atts']['layout']; ?>">
    <?php
    $anchor = '<div class="iba-product-thumbnail"><a href="%s" title="%s">%s</a></div>';
    printf(
        $anchor,
        $options['atts']['url'],
        iba_product_title_and_subtitle($product->id),
        $product->get_image()
    );

    printf('<div class="iba-product-title">%s</div>', iba_product_title_and_subtitle($product->id));

    $cta_button = '<div class="iba-product-cta-btn"><a class="iba-product-cta-btn-link" href="%s">%s</a></div>';
    printf(
        $cta_button,
        $options['atts']['url'],
        $options['atts']['cta']
    );
    ?>
</div>
