<?php

namespace SEVEN_TECH_Portfolio\Taxonomies;

class TaxonomiesProjectTags
{
    public function __construct()
    {
        add_action('init', [$this, 'custom_taxonomy']);
        add_filter('post_type_link', [$this, 'projects_permalink_structure'], 10, 4);
    }

    function custom_taxonomy()
    {
        $labels = array(
            'name' => 'Project Tags',
            'singular_name' => 'Project Tag',
            'search_items' => 'Search Project Tags',
            'add_new_item' => 'Add Project Tag',
            'all_items' => 'All Project Tags',
            'new_item_name' => 'Project Tag Name',
            'not_found' => 'Project Tag Not Found',
            'not_found_in_trash' => 'No items found in trash',
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit Project Tag',
            'update_item' => 'Update Project Tag',
            'add_new_item' => 'Add New Project Tag',
            'add_or_remove_items' => 'Add or remove Project Tag',
            'choose_from_most_used' => 'Choose from most used Project Tags'
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'projects/tag'
            ),
            'menu_position' => 3,
            'exclude_from_search' => false,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count'
        );

        register_taxonomy('project_tags', 'portfolio', $args);
    }

    function projects_permalink_structure($post_link, $post, $leavename, $sample)
    {

        if (false !== strpos($post_link, '%projects%')) {
            $projects_type_term = get_the_terms($post->ID, 'project_tags');
            if (!empty($projects_type_term))
                $post_link = str_replace('%projects%', array_pop($projects_type_term)->slug, $post_link);
            else
                $post_link = str_replace('%projects%', 'uncategorized', $post_link);
        }
        return $post_link;
    }
}
