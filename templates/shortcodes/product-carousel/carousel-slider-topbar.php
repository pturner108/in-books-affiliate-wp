<?php $options = iba_get_shortcodes_atts('product_carousel'); ?>

<div class="shop-cate-heading landing-page-heading <?php echo $options['atts']['skin']; ?>">
    <?php echo '<h2 class="carousel-header">' . $options['atts']['header'] . '</h2>'; ?>

    <?php
    /**
     * Display additional linkable header for mobile
     */
    printf(
        '<h2 class="carousel-link-header"><a href="%1$s" title="%2$s">%2$s</a></h2>',
        $options['atts']['link_to_caption'],
        $options['atts']['header']
    );
    ?>

    <a class="view-all" href="<?php echo $options['atts']['link_to_caption']; ?>">
        <?php echo __($options['atts']['see_more_caption'], 'iba'); ?>
    </a>
</div>

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
                $price_carousel = '<span class="book-price">' . $display_format . ': ' . $paperback_price . '</span>';

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
                // Products with no featured image will be excluded
                if (!has_post_thumbnail()) continue;
                ?>
                <div class="book-slide">
                    <div class="inner-box">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <div class="slide-detail">
                            <h5>
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo iba_product_title_and_subtitle();?>
                                </a>
                            </h5>
                            <span><?php echo $authors; ?></span>
                            <?php echo $price_carousel; ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="slideshow-pager">
            <span id="<?php echo $options['atts']['slider_prev_ID']; ?>" class="prev"></span>
            <span id="<?php echo $options['atts']['slider_next_ID']; ?>" class="next"></span>
        </div>
    </div>
</div>

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
            autoReload: true,
            breaks: [{
                screen: 0,
                slides: 3,
                pager: false
            }, {
                screen: 480,
                slides: 5
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
                slideMargin: 70,
            }]
        };

        // Book carousel slider on Shop Landing Page
        $(slider_ID).bxSlider(shopSliderOptions);
    })(jQuery);
//--><!]]></script>
