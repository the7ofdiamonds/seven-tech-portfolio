<?php

namespace SEVEN_TECH_Portfolio\Taxonomies;

class Taxonomies
{
    public $taxonomies;

    public function __construct()
    {
        $this->taxonomies = [
            [
                'name' => 'Project Types',
                'singular' => 'Project Types',
                'plural' => 'Project Types',
                'file_name' => 'ProjectTypes',
                'slug' => 'projects/type',
                'menu_position' => 3,
                'taxonomy' => 'project_types',
                'post_type' => 'portfolio'
            ], [
                'name' => 'Project Tags',
                'singular' => 'Project Tags',
                'plural' => 'Project Tags',
                'file_name' => 'ProjectTags',
                'slug' => 'projects/tag',
                'menu_position' => 3,
                'taxonomy' => 'project_tags',
                'post_type' => 'portfolio'
            ]
        ];

        add_action('init', [$this, 'custom_taxonomy']);

        // new TaxonomiesProjectTypes;
        // new TaxonomiesProjectTags;
    }

    function custom_taxonomy()
    {
        foreach ($this->taxonomies as $taxonomy) {
            $labels = array(
                'name' => $taxonomy['name'],
                'singular_name' => $taxonomy['singular'],
                'search_items' => 'Search ' . $taxonomy['plural'],
                'add_new_item' => 'Add ' . $taxonomy['singular'],
                'all_items' => 'All ' . $taxonomy['plural'],
                'new_item_name' => $taxonomy['singular'] . ' Name',
                'not_found' => $taxonomy['singular'] . ' Not Found',
                'not_found_in_trash' => 'No ' . $taxonomy['plural'] . ' found in trash',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit ' . $taxonomy['singular'],
                'update_item' => 'Update ' . $taxonomy['singular'],
                'add_new_item' => 'Add New ' . $taxonomy['singular'],
                'add_or_remove_items' => 'Add or remove ' . $taxonomy['plural'],
                'choose_from_most_used' => 'Choose from most used ' . $taxonomy['plural']
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
                    'slug' => $taxonomy['slug']
                ),
                'menu_position' => $taxonomy['menu_position'],
                'exclude_from_search' => false,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count'
            );

            register_taxonomy($taxonomy['taxonomy'], $taxonomy['post_type'], $args);
        }
    }

    function getTaxTermLinks($post_id, $taxonomy)
    {
        $terms = wp_get_post_terms($post_id, $taxonomy, array('fields' => 'all'));

        $term_links = [];

        foreach ($terms as $term) {
            $term = get_term_by('slug', $term->slug, $taxonomy);

            if ($term) {
                $term_link = get_term_link($term);

                $term_links[] = [
                    'name' => $term->name,
                    'slug' => $term_link
                ];
            }
        }

        return $term_links;
    }
}
