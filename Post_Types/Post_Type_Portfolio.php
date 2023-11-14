<?php

namespace SEVEN_TECH\Portfolio\Post_Types;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Portfolio;

class Post_Type_Portfolio
{
    public function __construct()
    {
        add_action('admin_init', function () {
            new Portfolio;
        });

        $this->custom_post_type();
    }

    function custom_post_type()
    {
        error_log('portfolio post type');

        $labels = array(
            'name' => 'PORTFOLIO',
            'singular_name' => 'Project',
            'add_new' => 'Add ' . 'Project',
            'all_items' => 'Portfolio',
            'add_new_item' => 'Add New ' . 'Project',
            'edit_item' => 'Edit ' . 'Project',
            'new_item' => 'New ' . 'Project',
            'view_item' => 'View ' . 'Project',
            'search_item' => 'Search ' . 'Portfolio',
            'not_found' => 'No ' . 'Portfolio' . ' were Found',
            'not_found_in_trash' => 'No ' . 'Project' . ' found in trash',
            'parent_item_colon' => 'Parent ' . 'Project'
        );

        $args = array(
            'labels' => $labels,
            'show_ui' => true,
            'menu_icon' => '',
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => array(
                'with_front' => false,
                'slug'       => 'portfolio'
            ),
            'hierarchical' => true,
            'supports' => [
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'custom-fields',
                'revisions',
                'page-attributes',
            ],
            'taxonomies' => array('category', 'post_tag'),
            'menu_position' => 13,
            'exclude_from_search' => false
        );

        register_post_type('portfolio', $args);
    }
}
