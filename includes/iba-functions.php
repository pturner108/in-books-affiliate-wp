<?php
if (!function_exists('iba_get_related_posts')) {
    /**
     * Functions that handle related posts
     *
     * @param null $post_id the post to retrieve connections for
     * @param array $args 'include_ai' = true when results should include 'artificial intelligence', 'max' the number of posts to return, -1 for all
     * @return array posts related to the one given
     */
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

if (!function_exists('iba_post_query_format_not')) {
    /**
     * @param string $format type of format to exclude
     * @return array query excluding format
     */
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

if (!function_exists('iba_post_query_format_in')) {
    /**
     * @param string|array $format types to include in results
     * @return array query excluding format
     */
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

if (!function_exists('iba_get_related_via_ai')) {
    /**
     * Returns posts related to the one provided
     * @param $post WP_Post to to retrieve related posts for
     * @param $post_type string type of relations to retrieve
     * @param $post_status
     * @param $connected array of currently connected posts
     * @param int $max max to retrieve
     * @return array of posts related to this one via AI
     */
    function iba_get_related_via_ai($post, $post_type, $post_status, $connected, $max = 15) {
        // Check if current post's post type is product
        if ($post->post_type === 'product') {
            // Let's get product categories by it's Categories custom fields
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

        while ($i <= $max_runs && sizeof($related) < $max) {
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

if (!function_exists('iba_get_posts_with_multi_cat')) {
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

if (!function_exists('iba_get_products_with_multi_cat')) {
    /**
     * @param $post WP_Post the post with connections
     * @param $post_type string type of post
     * @param $post_status
     * @param array $exclude_post_ids exclude these IDS from results since they are already connected
     * @param $max int max results
     * @param $term_id int category id to look for
     * @param int $position position that category should appear in iba_category_{1|2|3}
     * @return array Posts that are related
     * @internal param $meta_value
     */
    function iba_get_products_with_multi_cat($post, $post_type, $post_status, $exclude_post_ids, $max, $term_id, $position = 1) {
        // exclude this post
        $exclude_post_ids[] = $post->ID;
        $related = array();

        $iba_category = "iba_category_{$position}";

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $max,
            'post_status' => $post_status,
            'post__not_in' => $exclude_post_ids,
            'meta_key' => 'iba_publication_date',
            'orderby' => 'meta_value_num',
            'meta_query' => array(
                array(
                    'key' => $iba_category,
                    'value' => $term_id,
                    'compare' => '='
                ),
                array(
                    'key' => $iba_category . '_rank',
                    'value' => 1,
                    'compare' => '='
                )
            )
        );

        $multi_cat_query = new WP_Query($args);
        $posts = $multi_cat_query->get_posts();

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $related[] = $post;
            }
        }

        return $related;
    }
}

if (!function_exists('iba_create_related_query')) {
    /**
     * @param $args
     * @param $post
     * @param $type
     * @return array
     */
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

if (!function_exists('iba_get_post_categories')) {
    /**
     * Returns category array for the given post, or if null the current post
     * @param null $post_id in if null uses #get_the_ID
     *
     * @return array|null
     */
    function iba_get_post_categories($post_id = null) {
        $post_id = mdx_default_post_id($post_id);

        if (class_exists('INBM_Multiple_Category_Chooser')) {
            return INBM_Multiple_Category_Chooser::get_categories($post_id);
        }

        return get_the_category($post_id);
    }
}

if (!function_exists('iba_get_product_categories')) {
    /**
     * Returns category array for the given posttype product, or if null the current product
     * @param null $post_id in if null uses #get_the_ID
     *
     * @return array
     */
    function iba_get_product_categories($post_id = null) {
        $post_id = mdx_default_post_id($post_id);

        $iba_cats = array(
            get_post_meta($post_id, 'iba_category_1', true),
            get_post_meta($post_id, 'iba_category_2', true),
            get_post_meta($post_id, 'iba_category_3', true)
        );

        $iba_cats = array_filter($iba_cats);

        $categories = array();
        foreach ($iba_cats as $cat_id) {
            $cat = get_term($cat_id, 'category');
            if (!is_wp_error($cat)) {
                $categories[] = $cat;
            }
        }

        return $categories;
    }
}

if (!function_exists('iba_get_shortcodes_atts')) {
    /**
     * Retrieve list of all shortcode with their atts
     *
     * @param $shortcode string
     * @return array
     */
    function iba_get_shortcodes_atts($shortcode) {
        return \IBA\Shortcodes::get_atts($shortcode);
    }
}

if (!function_exists('iba_get_product_contributors')) {
    /**
     * Retrieve ACF Contributor fields for single product
     *
     * @param $post_id mixed
     * @param $include_if string
     * @return array
     */
    function iba_get_product_contributors($post_id, $include_if = 'description') {
        $contributors = array();

        for ($loopnum = 1; $loopnum < 4; $loopnum++) {
            $contributer_id = get_field("iba_contributor_" . $loopnum . "_id", $post_id);
            if ($contributer_id) {
                $term_obj = get_term($contributer_id, 'contributor');

                if (!is_object($term_obj)) continue;

                $contributor_name = get_field('iba_contributor_display_name', 'contributor_' . $term_obj->term_taxonomy_id);
                $contributer_id = 'contributor-tab-' . $contributer_id;
                /**
                 * Exclude contributor if no display_name and description
                 */
                if (isset($term_obj->{$include_if})
                    && !empty($term_obj->{$include_if})
                    && !empty($contributor_name))
                {
                    $contributors[$contributer_id]['name'] = get_field('iba_contributor_display_name', 'contributor_' . $term_obj->term_taxonomy_id);
                    $contributors[$contributer_id]['description'] = $term_obj->description;
                    $contributors[$contributer_id]['img'] = get_field('iba_contributor_photo', 'contributor_' . $term_obj->term_taxonomy_id);
                    $contributor_choice = get_field_object("iba_contributor_" . $loopnum . "_role");
                    $contributor_role = $contributor_choice['choices'][get_field("iba_contributor_" . $loopnum . "_role", $post_id)];
                    $contributors[$contributer_id]['role'] = $contributor_role;
                }
            }
        }

        return $contributors;
    }
}

if (!function_exists('iba_get_marketing_copy')) {
    /**
     * Retrieve ACF Marketing copy fields for single product
     *
     * @param $post_id mixed
     * @return array
     */
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

        $product_details = iba_get_product_details($post_id);

        if ($product_details) {
            $marketing_copy[] = array(
                'title' => 'Product Details',
                'desc' => $product_details
            );
        }

        return $marketing_copy;
    }
}

if (!function_exists('iba_get_product_variations')) {
    /**
     * Get product variation with their attributes
     *
     * @param $product WC_Product
     * @return array
     */
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
    function iba_get_product_variation_term($varition, $taxonomy = 'pa_product-format') {
        return get_term_by('slug', $varition, $taxonomy);
    }
}

if (!function_exists('iba_get_product_default_attribute')) {
    /**
     * Get product default variation attribute's slug
     *
     * @param $product WC_Product
     * @return string
     */
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

if (!function_exists('iba_product_title_and_subtitle')) {
    /**
     * Get acf meta field iba_title + iba_subtitle with 60chars
     * Must be used within product loop
     *
     * @param int $post_id Optional.
     * @return string
     */
    function iba_product_title_and_subtitle($post_id = 0) {
        $title = get_field('iba_title', $post_id);
        $subtitle = get_field('iba_subtitle', $post_id);

        if (!$title) {
            return '';
        }

        $resolved_title = $title;

        if ($subtitle) {
            $resolved_title .= ': ' . $subtitle;
        }

        return $resolved_title;
    }
}

if (!function_exists('iba_get_product_details')) {
    /**
     * Get product acf meta fields
     *
     * @param int $post_id Optional.
     * @return string
     */
    function iba_get_product_details($post_id = 0) {
        $cats = '';

        $categories = get_the_terms($post_id, 'category');
        if ($categories) {
            $cats = array_map(function($cat) {
                return $cat->name;
            }, $categories);

            $cats = implode(', ', $cats);
        }

        $format_object = get_field_object('iba_display_format', get_the_ID());
        $format_object_value = get_field('iba_display_format');

        $format = $format_object_value && isset($format_object['choices'][$format_object_value])
            ? $format_object['choices'][$format_object_value]
            : '';

        $product_details = array(
            'ISBN' => get_field('iba_isbn13', $post_id),
            'Format' => $format,
            'Pages' => get_field('iba_page_count', $post_id),
            'Publisher' => get_field('iba_publisher_imprint', $post_id),
            'Pub Date' => iba_format_date(get_field('iba_publication_date', $post_id)),
            'Categories' => $cats,
        );

        $template = '<table class="product-details-content"><tbody>';
        foreach ($product_details as $pd_key => $pd_val) {
            $template .= '<tr>';
            $template .= "<th>{$pd_key}</th>";
            $template .= "<td>{$pd_val}</td>";
            $template .= '</tr>';
        }
        $template .= '</tbody></table>';

        return $template;
    }
}

if (!function_exists('iba_format_date')) {
    /**
     * Format date "201406" to "June 2014"
     *
     * @param int|string $date.
     * @return string
     */
    function iba_format_date($date) {
        // Bail early if date isn't valid,
        // 201406, 201305, are valid option, but 20141, 2014 are not
        if (strlen($date) !== 6) return '';

        $dateObj = DateTime::createFromFormat('!m', substr($date, -2));
        return $dateObj->format('F') . ' ' . substr($date, 0, 4);
    }
}
