<?php $options = iba_get_shortcodes_atts('product_carousel'); ?>
<h2 class="shop-cate-heading"><?php echo $options['atts']['header']; ?></h2>
<?php
$unique_prev = iba_random_unique_id();
$unique_next = iba_random_unique_id();
?>
<div class="bottom-slider b-slider">
    <div class="container">
        <div id="<?php echo $options['atts']['slider_ID']; ?>">
            <?php
            while ($options['query']->have_posts()) {
                $options['query']->the_post();
                $product_ = wc_get_product(get_the_ID());
                $paperback_price = $product_->get_display_price() ? wc_price($product_->get_display_price()) : null;

                $field = get_field_object('iba_display_format');
                $value = get_field('iba_display_format');

                $display_format = $value ? $field['choices'][$value] : 'Price';
                $price_carousel = sprintf(
                    '<span class="book-price">%s: %s</span>',
                    $display_format,
                    $paperback_price
                );

                if ($product_->is_type('variable')) {
                    $price_carousel = '';
                    $variation_ids = $product_->get_children();
                    foreach($variation_ids as $var_id) {
                        $var_data = new WC_Product_Variation($var_id);
                        $va = wc_get_product_variation_attributes($var_id);
                        foreach($va as $key=>$val) {
                            $price_carousel .= '<span class="book-price">';
                            $price_carousel .= ucfirst(str_replace('-', '', $val)) . ': ';
                            $current_product = new WC_Product_Variation($var_id);
                            $price_carousel .= wc_price($current_product->get_display_price());
                            $price_carousel .= '</span>';
                        }
                    }
                }
                $contributors = iba_get_product_contributors(get_the_ID());
                $con = '';
                foreach($contributors as $contributor){
                    if(empty($contributor['name'])) {
                        continue;
                    }
                    $con .= $contributor['name']. ', ';
                }
                $authors = rtrim($con, ', ');
                if (!has_post_thumbnail()) continue;
                ?>
                <div class="book-slide">
                    <div class="inner-box">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                        <div class="slide-detail">
                            <h5>
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo iba_product_title_and_subtitle();?>
                                </a>
                            </h5>
                            <span class="writer-name"><?php echo $authors; ?></span>
                            <?php echo $price_carousel; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>
    </div>
    <div class="slideshow-pager">
        <span id="<?php echo $options['atts']['slider_prev_ID']; ?>" class="prev"></span>
        <span id="<?php echo $options['atts']['slider_next_ID']; ?>" class="next"></span>
    </div>
</div>

<?php if ($options['atts']['show_view_button']) { ?>
<div class="load-more view-all-staff">
    <a href="<?php echo $options['atts']['show_view_button_link']; ?>">
        <?php echo $options['atts']['show_view_button_text']; ?>
    </a>
</div>
<?php } ?>

<script><!--//--><![CDATA[//><!--
    if (!window.jQuery) {
        throw new Error('jQuery required for product carousel slider');
    }

    (function($) {
        var slider_ID = "#<?php echo $options['atts']['slider_ID']; ?>";
        var slider_next_ID = "#<?php echo $options['atts']['slider_next_ID']; ?>";
        var slider_prev_ID = "#<?php echo $options['atts']['slider_prev_ID']; ?>";

        var shopSliderOptions = {
            infiniteLoop: false,
            touchEnabled: true,
            pager: false,
            nextSelector: slider_next_ID,
            prevSelector: slider_prev_ID,
            nextText: ' ',
            prevText: ' ',
            moveSlides: 2,
            autoReload: true,
            breaks: [{
                screen: 0,
                slides: 3,
                pager: false
            }, {
                screen: 480,
                slides: 4
            }, {
                screen: 768,
                slides: 3,
                slideMargin: 40
            }, {
                screen: 980,
                slides: 4,
                slideMargin: 40
            }, {
                screen: 1300,
                slides: 5,
                slideMargin: 40
            }, {
                screen: 1536,
                slides: 5,
                slideMargin: 70
            }]
        };

        // Book carousel slider on Shop Landing Page
        $(slider_ID).bxSlider(shopSliderOptions);
    })(jQuery);
//--><!]]></script>
