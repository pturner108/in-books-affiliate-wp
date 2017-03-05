<?php $options = iba_get_shortcodes_atts('product_carousel'); ?>

<div class="product-carousel <?php echo $options['atts']['skin']; ?>">
  <div class="product-carousel-header">
    <div class="container">
      <h2 class="carousel-header">
        <a href="<?php echo __($options['atts']['url'], 'iba'); ?>"
           title="<?php echo esc_html(__($options['atts']['html_title'], 'iba')); ?>">


            <span class="iba-pdc-header">
                <?php echo $options['atts']['header']; ?>
            </span>
        </a>
      </h2>


        <?php if (!empty($options['atts']['sub_title'])) { ?>
          <div class="iba-pdc-subtitle"> <?php echo $options['atts']['sub_title']; ?></div>
        <?php } ?>

      <div class="view-all-link">
        <a class="view-all" href="<?php echo $options['atts']['url']; ?>">
            <?php echo __($options['atts']['see_more_caption'], 'iba'); ?>
        </a>
      </div>
    </div>
  </div>
  <div class="relative">
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
                    '<div class="book-price">%s: %s</div>',
                    $display_format,
                    $paperback_price
                );

                if ($product_->is_type('variable')) {
                    $price_carousel = '';
                    $variation_ids = $product_->get_children();
                    foreach ($variation_ids as $var_id) {
                        $var_data = new WC_Product_Variation($var_id);
                        $va = wc_get_product_variation_attributes($var_id);
                        foreach ($va as $key => $val) {
                            $price_carousel .= '<div class="book-price">';
                            $price_carousel .= ucfirst(str_replace('-', '', $val)) . ': ';
                            $current_product = new WC_Product_Variation($var_id);
                            $price_carousel .= wc_price($current_product->get_display_price());
                            $price_carousel .= '</div>';
                        }
                    }
                }
                $contributors = iba_get_product_contributors(get_the_ID());
                $con = '';
                foreach ($contributors as $contributor) {
                    if (empty($contributor['name'])) {
                        continue;
                    }
                    $con .= $contributor['name'] . ', ';
                }
                $authors = rtrim($con, ', ');
                // Products with no featured image will be excluded
                if (!has_post_thumbnail()) continue;
                ?>
              <div class="book-slide">
                <div class="inner-box">

                  <div class="slide-product-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                  </div>

                  <div class="slide-detail">
                    <h5 class="title">
                      <a href="<?php the_permalink(); ?>">
                          <?php echo iba_product_title_and_subtitle(); ?>
                      </a>
                    </h5>
                    <div class="author"><?php echo $authors; ?></div>
                    <div class="price"><?php echo $price_carousel; ?></div>
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
  </div>

  <div class="view-all-in-slider">
    <div class="button">
      <a href="<?php echo $options['atts']['show_view_button_link']; ?>">
          <?php echo $options['atts']['show_view_button_text']; ?>
      </a>
    </div>
  </div>

</div>

<script language="JavaScript">
  if (!window.jQuery) {
    throw new Error('jQuery required for product carousel slider');
  }
  (function ($) {
    var slider_ID = "#<?php echo $options['atts']['slider_ID']; ?>";
    var slider_next_ID = "#<?php echo $options['atts']['slider_next_ID']; ?>";
    var slider_prev_ID = "#<?php echo $options['atts']['slider_prev_ID']; ?>";
    var shopSliderOptions = {
      infiniteLoop: true,
      touchEnabled: true,
      pager: false,
      nextSelector: slider_next_ID,
      prevSelector: slider_prev_ID,
      nextText: ' ',
      prevText: ' ',
      speed: 1000,
      moveSlides: 1,
      autoReload: true,
      breaks: [{
        screen: 0,
        slides: <?php echo $options['atts']['@0']; ?>,
        moveSlides: 1,
        pager: false
      }, {
        screen: 568,
        moveSlides: 1,
        slides: <?php echo $options['atts']['@568']; ?>
      }, {
        screen: 768,
        slides: <?php echo $options['atts']['@768']; ?>,
        moveSlides: 2,
        slideMargin: 30
      }, {
        screen: 1024,
        slides: <?php echo $options['atts']['@1024']; ?>,
        slideMargin: 40,
        moveSlides: 3
      }, {
        screen: 1220,
        slides: <?php echo $options['atts']['@1220']; ?>,
        slideMargin: 40
      }, {
        screen: 1440,
        slides: <?php echo $options['atts']['@1440']; ?>,
        slideMargin: 50,
        moveSlides: 4
      },
        {
          screen: 1900,
          slides: <?php echo $options['atts']['@1900']; ?>,
          slideMargin: 70
        }]
    };
    $(slider_ID).bxSlider(shopSliderOptions);
  })(jQuery);
</script>
