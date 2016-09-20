<h1>CAROUSEL-SLIDER.php</h1>

<?php
$options = self::$atts_references['product_carousel'];
if ($options['skin'] != 'boxed') {
    return;
}

$args = array(
    'category_name' => $options['category'],
    'tax_query' => array(
        array(
            'taxonomy' => 'product_tag',
            'field'    => 'slug',
            'terms'    => $options['tag'],
        ),
    ),
    'posts_per_page' => $options['max'],
    'post_type' => 'product',
    'orderby' => array(
        'iba_category_rank_clause' => 'ASC',
        'iba_publication_date_clause' => 'DESC'
    ),
    /*'meta_query' => array(
        'iba_category_rank_clause' => array(
            'relation' => 'AND',
            array(
                'relation' => 'OR',
                array(
                    'key'     => 'iba_category_1',
                    'value' => $options['category'],
                    'compare' => '='
                ),
                array(
                    'key'     => 'iba_category_2',
                    'value' => $options['category'],
                    'compare' => '='
                ),
                array(
                    'key'     => 'iba_category_3',
                    'value' => $options['category'],
                    'compare' => '='
                ),
            ),
            array(
                'relation' => 'OR',
                array(
                    'key'     => 'iba_category_1_rank',
                    'type'    => 'numeric',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key'     => 'iba_category_2_rank',
                    'type'    => 'numeric',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key'     => 'iba_category_3_rank',
                    'type'    => 'numeric',
                    'compare' => 'EXISTS'
                )
            )
        ),
        'iba_publication_date_clause' => array(
            'key' => 'iba_publication_date',
            'type' => 'DATE',
            'compare' => 'EXISTS'
        )
    )*/
);

$carousel_query = new WP_Query($args);
if (!$carousel_query->have_posts()) {
    return '';
}
?>
<div class="heading-with-bg <?php echo $options['skin']; ?> ">
    <?php
    if (!empty(trim($options['header']))) {
        $carousel_title = $options['header'];
    } else {
        $carousel_title = ucwords(str_replace('-', ' ', $options['category']));
    }
    echo '<h2>' .$carousel_title . '</h2>';
    $category = get_term_by('slug', $options['category'], 'category');
    $cat_id = $category->term_id;
    ?>
    <a class="view-all" href="<?php echo get_category_link($cat_id); ?>">
        <?php echo __($options['see_more_caption'], 'iba'); ?>
    </a>
</div>
<div class="bottom-slider">
    <div class="container">
        <div class="product-book-slider landing-page-slider">
            <?php
            $unique_prev = iba_random_unique_id();
            $unique_next = iba_random_unique_id();
            ?>
            <div class="cycle-slideshow" data-cycle-fx="carousel" data-cycle-timeout="0"
                 data-cycle-carousel-visible="5" data-cycle-carousel-fluid="true" data-cycle-slides="> div"
                 data-cycle-next="#next<?php echo $unique_next; ?>"
                 data-cycle-prev="#prev<?php echo $unique_prev; ?>">
                <?php
                while ($carousel_query->have_posts()) {
                    $carousel_query->the_post();
                    $product_ = wc_get_product(get_the_ID());
                    $paperback_price = null;
                    $paper_type = 'Price';

                    if ($product_->is_type('variable')) {
                        $variation_ids = $product_->get_children();
                        foreach($variation_ids as $var_id) {
                            $va = wc_get_product_variation_attributes($var_id);
                            if($va['attribute_pa_cover-type'] == 'paperback') {
                                $paper_type = $va['attribute_pa_cover-type'];
                                $current_product = new WC_Product_Variation($var_id);
                                $paperback_price = $current_product->get_price_html();
                            }
                        }
                    }
                    ?>
                    <div class="product-book-slide">
                        <div class="book-detail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            <div class="slide-detail">
                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <span class="writer-name">Ryuichi Abe, Peter Hasket</span>
                                <span class="book-price"><?php echo ucwords($paper_type); ?>: <?php echo (is_null($paperback_price) ? $product_->get_price_html() : $paperback_price); ?></span>
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
    </div>
</div>