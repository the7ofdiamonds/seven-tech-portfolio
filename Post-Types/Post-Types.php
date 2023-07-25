<?php

namespace THFW_Portfolio\Post_Types;

/**
 * @package THFWPortfolio
 */

class Post_Types
{
    public function __construct()
    {
        add_action('init', [$this, 'custom_post_type']);
        add_action('add_meta_boxes', array($this, 'add_post_meta_boxes'));
        add_action('save_post', array($this, 'save_post_project_button'));
    }

    function custom_post_type()
    {
        $labels = array(
            'name' => 'Portfolio',
            'singular_name' => 'Project',
            'add_new' => 'Add Project',
            'all_items' => 'Portfolio',
            'add_new_item' => 'Add Project',
            'edit_item' => 'Edit Item',
            'new_item' => 'New Item',
            'view_item' => 'View Item',
            'search_item' => 'Search Portfolio',
            'not_found' => 'No Items Found',
            'not_found_in_trash' => 'No items found in trash',
            'parent_item_colon' => 'Parent Item'
        );

        $args = array(
            'labels' => $labels,
            'show_ui' => true,
            'menu_icon' => 'dashicons-portfolio',
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'public' => true,
            'has_archive' => 'portfolio',
            'publicly_queryable' => true,
            'capability_type' => 'post',
            'query_var' => true,
            'rewrite' => array(
                'with_front' => true,
                'slug'       => 'portfolio/%projects%'
            ),
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'custom-fields',
                'revisions',
                'page-attributes',
                'post-attributes'
            ),
            'taxonomies' => array(
                'projects',
                'category',
                'post_tag'
            ),
            'menu_position' => 6,
            'exclude_from_search' => false
        );

        register_post_type('portfolio', $args);
        flush_rewrite_rules();
    }


    // add event date field to events post type
    function add_post_meta_boxes()
    {
        add_meta_box(
            "post_metadata_project_button", // div id containing rendered fields
            "Project Button", // section heading displayed as text
            [$this, 'post_meta_box_project_button'], // callback function to render fields
            "portfolio", // name of post type on which to render fields
            "normal", // location on the screen
            "low" // placement priority
        );
    }

    function save_post_project_button()
    {
        global $post;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // if ( get_post_status( $post->ID ) === 'auto-draft' ) {
        //     return;
        // }
        update_post_meta($post->ID, "_project_button", sanitize_text_field($_POST["_project_button"]));
    }

    function post_meta_box_project_button()
    {
        global $post;
        $custom = get_post_custom($post->ID);
        $projectButton = $custom["_project_button"][0];

        echo "<input type=\"text\" name=\"_project_button\" value=\"" . $projectButton . "\" placeholder=\"Project Button\">";
    }
}
