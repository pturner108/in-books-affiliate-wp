<?php
$options = iba_get_shortcodes_atts('product');
/**
 * @var WC_Product $product
 */
$product = $options['query'];
?>

<div class="iba-product layout-<?php echo $options['atts']['layout']; ?>">
    <?php
    $anchor = '<a href="%s" title="%s">%s</a>';
    printf(
        $anchor,
        $options['atts']['url'],
        iba_product_title_and_subtitle($product->id),
        $product->get_image()
    );
    ?>
</div>
