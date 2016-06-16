<?php
/**
 * Functions that handle related posts
 * @param null $post_id the post to retrieve connections for
 * @param array $args 'include_ai' = true when results should include 'artificial intelligence', 'max' the number of posts to return, -1 for all
 * @return array posts related to the one given
 *
 */
if (!function_exists('iba_get_related_posts')) {
    function iba_get_related_posts($post_id = null, $args = array()) {
        $defaults = array(
            'include_ai' => 'true',
            'max' => '50',
            'post_status' => 'publish',
            'p2p_type' => 'related_post_to_post'
        );

        $args = wp_parse_args($args, $defaults);
        $post_id = mdx_default_post_id($post_id);
        $post = get_post($post_id);

        $query = iba_create_related_query($args, $post, $args['p2p_type']);
        $query['tax_query'] = iba_post_query_format_not('dharma-dose');

        $connected = get_posts($query);
        wp_reset_postdata();

        // return results if total found is >= max, or if ai is not supposed to be used
        if (sizeof($connected) >= $args['max'] || $args['include_ai'] == 'false') {
            return array('all' => $connected, 'direct' => $connected, 'ai' => array());
        }

        // get the ai posts
        $remaining = $args['max'] - sizeof($connected);
        $post_type = 'post';
        if ($args['p2p_type'] == 'related_post_to_product' || $args['p2p_type'] == 'related_product_to_product') {
            $post_type = 'product';
        }
        $ai = iba_get_related_via_ai($post, $post_type, $args['post_status'], $connected, $remaining);
        wp_reset_postdata();


        $all = array_merge($connected, $ai);

        return array('all' => $all, 'direct' => $connected, 'ai' => $ai);
    }
}

/**
 * @param string $format type of format to exclude
 * @return array query excluding format
 */
if (!function_exists('iba_post_query_format_not')) {
    function iba_post_query_format_not($format) {
        return array(
            array(
                'taxonomy' => 'custom_post_format',
                'field' => 'slug',
                'terms' => $format,
                'operator' => 'NOT IN'
            )
        );
    }
}

/**
 * @param string|array $format types to include in results
 * @return array query excluding format
 */
if (!function_exists('iba_post_query_format_in')) {
    function iba_post_query_format_in($format) {
        return array(
            array(
                'taxonomy' => 'custom_post_format',
                'field' => 'slug',
                'terms' => $format,
                'operator' => 'IN'
            )
        );
    }
}

if (!function_exists('iba_post_to_id')) {
    function iba_post_to_id($post) {
        return $post->ID;
    }
}

/**
 * Returns posts related to the one provided
 * @param $post WP_Post to to retrieve related posts for
 * @param $post_type string type of relations to retrieve
 * @param $post_status
 * @param $connected array of currently connected posts
 * @param int $max max to retrieve
 * @return array of posts related to this one via AI
 */
if (!function_exists('iba_get_related_via_ai')) {
    function iba_get_related_via_ai($post, $post_type, $post_status, $connected, $max = 15) {
        if ($post_type === 'product') {
            $categories = iba_get_product_categories($post->ID);
        } else {
            $categories = iba_get_post_categories($post->ID);
        }
        $connected_ids = array_map('iba_post_to_id', $connected);
        if (empty($categories)) {
            return array();
        }

        $i = 1;
        $max_runs = 3;
        $related = array();
        $needed = $max - sizeof($related);

        while ($i < $max_runs && sizeof($related) < $max) {
            $term_id = $categories[0]->term_id;
            if ($post_type === 'product') {
                $related_post = iba_get_products_with_multi_cat($post, $post_type, $post_status, $connected_ids, $needed, $term_id, $i);
            } else {
                $related_post = iba_get_posts_with_multi_cat($post, $post_type, $post_status, $connected_ids, $needed, $term_id, $i);
            }
            $related = array_merge($related, $related_post);

            $needed = $max - sizeof($related);
            $i++;
        }


        return $related;
    }
}

/**
 * @param $post WP_Post the post with connections
 * @param $post_type string type of post
 * @param $post_status
 * @param array $exclude_post_ids exclude these IDS from results since they are already connected
 * @param $max int max results
 * @param $term_id int category id to look for
 * @param int|string $position position that category should appear in multicat: 1, 2, 3
 * @return array Posts that are related
 * @internal param $meta_value
 */
if (!function_exists('iba_get_posts_with_multi_cat')) {
    function iba_get_posts_with_multi_cat($post, $post_type, $post_status, $exclude_post_ids, $max, $term_id, $position = 'any') {
        // exclude this post
        $exclude_post_ids[] = $post->ID;

        $meta_value = '[[:<:]]' . $term_id . '[[:>:]]';

        // starts with term, ends with word break
        if ($position === 1) {
            $meta_value = '^' . $term_id . '[[:>:]]';

        } elseif ($position === 2) {
            $meta_value = '^.*,' . $term_id . '[[:>:]]';

        } elseif ($position === 3) {
            $meta_value = '^.*,.*,' . $term_id . '[[:>:]]';
        }

        $related = get_posts(array(
            'post_type' => $post_type,
            'meta_key' => '_ds1_multi_cat',
            'meta_value' => $meta_value,
            'meta_compare' => 'REGEXP',
            'posts_per_page' => $max,
            'post_status' => $post_status,
            'post__not_in' => $exclude_post_ids,
            'tax_query' => iba_post_query_format_not('dharma-dose')
        ));
        return $related;
    }
}

/**
 * @param $post WP_Post the post with connections
 * @param $post_type string type of post
 * @param $post_status
 * @param array $exclude_post_ids exclude these IDS from results since they are already connected
 * @param $max int max results
 * @param $term_id int category id to look for
 * @param int|string $position position that category should appear in multicat: 1, 2, 3
 * @return array Posts that are related
 * @internal param $meta_value
 */
if (!function_exists('iba_get_products_with_multi_cat')) {
    function iba_get_products_with_multi_cat($post, $post_type, $post_status, $exclude_post_ids, $max, $term_id, $position = 'any') {
        // exclude this post
        $exclude_post_ids[] = $post->ID;
        $related = array();

        $args = array(
            'post_type' => $post_type,
            'category__in' => $term_id,
            'posts_per_page' => $max,
            'post_status' => $post_status,
            'post__not_in' => $exclude_post_ids
        );

        $multi_cat_query = new WP_Query($args);
        if ($multi_cat_query->have_posts()) {
            while($multi_cat_query->have_posts()) {
                $multi_cat_query->the_post();
                global $post;
                $related[] = $post;
            }
        }

        return $related;
    }
}

/**
 * @param $args
 * @param $post
 * @param $type
 * @return array
 */
if (!function_exists('iba_create_related_query')) {
    function iba_create_related_query($args, $post, $type) {
        $query_vars = array(
            'connected_type' => $type,
            'connected_items' => $post,
            'post_status' => $args['post_status'],
            'suppress_filters' => false
        );

        $args['max'] = intval($args['max']);

        if ($args['max'] == -1) {
            $query_vars['nopaging'] = true;
        } else {
            $query_vars['posts_per_page'] = $args['max'];
        }


        return $query_vars;
    }
}

/**
 * Returns category array for the given post, or if null the current post
 * @param null $post_id in if null uses #get_the_ID
 * @return array|null
 */
if (!function_exists('iba_get_post_categories')) {
    function iba_get_post_categories($post_id = null) {
        $post_id = mdx_default_post_id($post_id);

        if (class_exists('INBM_Multiple_Category_Chooser')) {
            return INBM_Multiple_Category_Chooser::get_categories($post_id);
        }

        return get_the_category($post_id);
    }
}

/**
 * Returns category array for the given posttype product, or if null the current product
 * @param null $post_id in if null uses #get_the_ID
 * @return array|null
 */
if (!function_exists('iba_get_product_categories')) {
    function iba_get_product_categories($post_id = null) {
        $post_id = mdx_default_post_id($post_id);

        return get_the_terms($post_id, 'category');
    }
}

/**
 * Retrieve list of all shortcode with their atts
 *
 * @param $shortcode string
 * @return array
 */
if (!function_exists('iba_get_shortcodes_atts')) {
    function iba_get_shortcodes_atts($shortcode) {
        return \IBA\Shortcodes::get_atts($shortcode);
    }
}

/**
 * Retrieve ACF Contributor fields for single product
 *
 * @param $post_id mixed
 * @return array
 */
if (!function_exists('iba_get_product_contributors')) {
    function iba_get_product_contributors($post_id) {
        $contributors = array();

        for ($loopnum = 1; $loopnum < 4; $loopnum++) {
            $contributer_id = get_field("iba_contributor_" . $loopnum . "_id", $post_id);
            if ($contributer_id) {
                $term_obj = get_term($contributer_id, 'contributor');
                if ($term_obj) {
                    $contributors[$contributer_id]['name'] = get_field('iba_contributor_display_name', 'contributor_' . $term_obj->term_taxonomy_id);
                    $contributors[$contributer_id]['description'] = $term_obj->description;
                    $contributors[$contributer_id]['img'] = get_field('iba_contributor_photo', 'contributor_' . $term_obj->term_taxonomy_id);
                    $contributor_choice = get_field_object("iba_contributor_" . $loopnum . "_role");
                    $contributor_role = $contributor_choice['choices'][get_field("iba_contributor_" . $loopnum . "_role")];
                    $contributors[$contributer_id]['role'] = $contributor_role;
                }
            }
        }

        return $contributors;
    }
}

/**
 * Retrieve ACF Marketing copy fields for single product
 *
 * @param $post_id mixed
 * @return array
 */
if (!function_exists('iba_get_marketing_copy')) {
    function iba_get_marketing_copy($post_id) {
        $marketing_copy = array();

        $staff_review = get_field('iba_staff_review', $post_id);
        $excerpt = get_field('iba_excerpt', $post_id);
        $table_of_contents = get_field('iba_table_of_contents', $post_id);
        $praise = get_field('iba_praise', $post_id);

        if ($staff_review) {
            $marketing_copy[] = array(
                'title' => 'Staff Review',
                'desc' => $staff_review
            );
        }

        if ($excerpt) {
            $marketing_copy[] = array(
                'title' => 'Book Excerpt',
                'desc' => $excerpt
            );
        }

        if ($table_of_contents) {
            $marketing_copy[] = array(
                'title' => 'Table of Contents',
                'desc' => $table_of_contents
            );
        }

        if ($praise) {
            $marketing_copy[] = array(
                'title' => 'Praise',
                'desc' => $praise
            );
        }

        return $marketing_copy;
    }
}

/**
 * Get product variation with their attributes
 *
 * @param $product WC_Product
 * @return array
 */
if (!function_exists('iba_get_product_variations')) {
    function iba_get_product_variations($product) {
        $vars = array();
        $attributes = $product->get_variation_attributes();
        foreach ($attributes as $taxonomy => $variations) {
            foreach ($variations as $variation) {
                $vars[] = get_term_by('slug', $variation, $taxonomy);
            }
        }
        return $vars;
    }
}

if (!function_exists('iba_get_product_variation_term')) {
    function iba_get_product_variation_term($varition, $taxonomy = 'pa_cover-type') {
        return get_term_by('slug', $varition, $taxonomy);
    }
}

/**
 * Get product default variation attribute's slug
 *
 * @param $product WC_Product
 * @return string
 */
if (!function_exists('iba_get_product_default_attribute')) {
    function iba_get_product_default_attribute($product) {
        $variation_name = null;
        $variation_ids = $product->get_children();
        foreach($variation_ids as $variation_id) {
            $var_data = new WC_Product_Variation($variation_id);
            $default_variation_slug = $var_data->default_attributes;
            foreach($default_variation_slug as $key => $val) {
                $variation_name = $val;
            }
        }

        return $variation_name;
    }
}
