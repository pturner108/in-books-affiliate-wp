<?php
namespace IBA;

/**
 * Class Related_List_Table
 *
 * @since 1.0.0
 */
require_once LIB_DIR . 'class-wp-list-table.php';

class Related_List_Table extends WP_List_Table {

    function __construct() {
        parent::__construct(array(
            'singular' => 'single label',
            'plural' => 'plural label',
        ));
    }

    function get_columns() {
        return $columns = array(
            'count' => __('count'),
            'id' => __('ID'),
            'title' => __('Title'),
            'format' => __('Format'),
            'status' => __('Post Status'),
            'categories' => __('Categories'),
        );
    }

    function prepare_items($related) {
        $this->items = $this->table_data($related);

        $this->_column_headers = array($this->get_columns(), array(), array());
    }

    private function table_data($related) {
        $data = array();

        $i = 0;
        foreach ($related as $post) {
            $i++;
            $post_id = $post->ID;
            $format = ds1_get_post_format($post_id);

            $item['count'] = $i;
            $item['id'] = $post_id;
            $item['title'] = sprintf('<a href="%s">%s</a>', get_the_permalink($post), get_the_title($post));
            $item['format'] = $format->name;
            $item['categories'] = implode(', ', get_post_meta($post_id, '_inbm_multi_cat'));

            $item['status'] = get_post_status($post_id);

            $data[] = $item;
        }

        return $data;
    }

    function column_default($item, $column_name) {
        return $item[$column_name];
    }

    protected function display_tablenav($which) {
        return;
    }

}
