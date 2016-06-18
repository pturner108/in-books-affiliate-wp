<?php $options = iba_get_shortcodes_atts('product_carousel'); ?>
<h2 class="shop-cate-heading"><?php echo $options['atts']['header']; ?></h2>

<?php
$unique_prev = iba_random_unique_id();
$unique_next = iba_random_unique_id();
?>
<div class="product-book-slider category-page-slider">
    <div class="cycle-slideshow" data-cycle-fx="carousel" data-cycle-timeout="0"
         data-cycle-carousel-visible="4" data-cycle-carousel-fluid="true" data-cycle-slides="> div"
         data-cycle-next="#next<?php echo $unique_next; ?>"
         data-cycle-prev="#prev<?php echo $unique_prev; ?>">
        <?php
        while ($options['query']->have_posts()) {
            $options['query']->the_post();
            $product_ = wc_get_product(get_the_ID());
            $paperback_price = null;
            $paper_type = 'Price';

            if ($product_->is_type('variable')) {
                $variation_ids = $product_->get_children();
                foreach($variation_ids as $var_id) {
                    $var_data = new WC_Product_Variation($var_id);
                    $default_variation_slug = $var_data->default_attributes;
                    $va = wc_get_product_variation_attributes($var_id);
                    foreach($va as $key=>$val) {
                        if(($default_variation_slug[str_replace('attribute_', '' , $key)] == $val)) {
                            $paper_type = ucfirst(str_replace('-', '', $val));
                            $current_product = new WC_Product_Variation($var_id);
                            $paperback_price = $current_product->get_price_html();
                        }
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
                <div class="book-box">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                    <div class="slide-detail">
                        <h5>
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if(get_field('iba_title')) {
                                    the_field('iba_title'); ?>: <?php
                                }
                                the_field('iba_subtitle', get_the_ID()); ?>
                            </a>
                        </h5>
                        <span class="writer-name"><?php echo $authors; ?></span>
                        <span class="book-price">
                            <?php echo $paper_type; ?>:
                            <?php echo (is_null($paperback_price) ? $product_->get_price_html() : $paperback_price); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class=cycle-slideshow-pager>
        <a href="#" id="prev<?php echo $unique_prev; ?>" class="fa fa-angle-left"></a>
        <a href="#" id="next<?php echo $unique_next; ?>" class="fa fa-angle-right"></a>
    </div>
</div>

<?php if ($options['atts']['show_view_button']) { ?>
<div class="load-more view-all-staff">
    <a href="<?php echo $options['atts']['show_view_button_link']; ?>">
        <?php echo $options['atts']['show_view_button_text']; ?> &gt;
    </a>
</div>
<?php } ?>