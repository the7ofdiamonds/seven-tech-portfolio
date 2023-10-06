<?php

namespace THFW_Portfolio\Post_Types;

class Portfolio
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
                'slug' => 'portfolio',
                'feeds' => true, // Add this line for feed support
                'pages' => true, // Add this line for pagination support
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
                'project_types',
                'project_tags'
            ),
            'menu_position' => 6,
            'exclude_from_search' => false
        );
    
        register_post_type('portfolio', $args);
        flush_rewrite_rules();
    }
    
    function add_custom_meta_boxes()
    {
        add_meta_box(
            "post_metadata_project_button",
            "Project Button",
            [$this, 'post_meta_box_project_button'],
            "projects",
            "side",
            "low"
        );
    }
    
    function post_meta_box_project_button()
    {
        $postID = get_the_ID();
        $projectButton = get_post_meta($postID, '_project_button', true); ?>
    
        <input type='text' name="_project_button" value="<?php echo esc_attr($projectButton); ?>" placeholder="Project Button">
    <?php }
    
    function save_post_project_button($postID)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
    
        $projectButton = isset($_POST["_project_button"]) ? sanitize_text_field($_POST["_project_button"]) : '';
        update_post_meta($postID, "_project_button", $projectButton);
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
}
