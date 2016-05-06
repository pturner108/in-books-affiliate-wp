<div class="gray-bar">
    <div class="container">
        <span class="title"><?php echo self::$atts_references['product_carousel']['header']; ?></span>
        <a class="show-all" href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">SHOP ALL BOOKS</a>
    </div>
</div>

<div class="bottom-slider">
    <div class="container">
        <?php
        $args = array(
            'category_name' => self::$atts_references['product_carousel']['category'],
            'posts_per_page' => self::$atts_references['product_carousel']['max'],
            'post_type' => 'product',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $carousel_query = new WP_Query($args);
        ?>
        <?php if (1) { //if ($carousel_query->have_posts()) { $carousel_query->the_post(); ?>
        <div class="cycle-slideshow" data-cycle-fx="carousel" data-cycle-timeout="0"
             data-cycle-carousel-visible="5" data-cycle-carousel-fluid="true" data-cycle-slides="> div"
             data-cycle-next="#next"
             data-cycle-prev="#prev">
            <?php /* while($carousel_query->have_posts()) { ?>
            <div class="book-slide">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
                <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/img/book2.png" alt="Book"></a>
                <div class="slide-detail">
                    <h5><a href="javascript:;"><?php the_title(); ?></a></h5>
                    <span>Ryuichi Abe, Peter Hasket</span>
                    <span class="book-price">Paperback: $19.95</span>
                </div>
            </div>
            <?php } */ ?>
            <div class="book-slide">
                <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/img/book2.png" alt="Book"></a>
                <div class="slide-detail">
                    <h5><a href="javascript:;"><?php the_title(); ?></a></h5>
                    <span>Ryuichi Abe, Peter Hasket</span>
                    <span class="book-price">Paperback: $19.95</span>
                </div>
            </div>
            <div class="book-slide">
                <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/img/book2.png" alt="Book"></a>
                <div class="slide-detail">
                    <h5><a href="javascript:;">Fool Zen Master Ryokan</a></h5>
                    <span>Ryuichi Abe, Peter Hasket</span>
                    <span class="book-price">Paperback: $19.95</span>
                </div>
            </div>
            <div class="book-slide">
                <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/img/book3.png" alt="Book"></a>
                <div class="slide-detail">
                    <h5><a href="javascript:;">Great Fool Zen Master Ryokan: Poems</a></h5>
                    <span>Ryuichi Abe, Peter Hasket</span>
                    <span class="book-price">Paperback: $19.95</span>
                </div>
            </div>
            <div class="book-slide">
                <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/img/book4.png" alt="Book"></a>
                <div class="slide-detail">
                    <h5><a href="javascript:;">Poems Poems Poems Poems</a></h5>
                    <span>Ryuichi Abe, Peter Hasket</span>
                    <span class="book-price">Paperback: $19.95</span>
                </div>
            </div>
            <div class="book-slide">
                <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/img/book5.png" alt="Book"></a>
                <div class="slide-detail">
                    <h5><a href="javascript:;">Great Fool Zen Master Ryokan: Poems</a></h5>
                    <span>Ryuichi Abe, Peter Hasket</span>
                    <span class="book-price">Paperback: $19.95</span>
                </div>
            </div>
        </div>

        <div class=cycle-slideshow-pager>
            <a href="#" id="prev" class="fa fa-angle-left"></a>
            <a href="#" id="next" class="fa fa-angle-right"></a>
        </div>
        <?php } else { ?>
        <h2 style="text-align: center;">Nothing to be seen here</h2>
        <?php } ?>
    </div>
</div>

<?php
/**
 * Options: self::$atts_references['product_carousel'];
 */
