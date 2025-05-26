<?php

namespace SEVEN_TECH\Portfolio\Model;

class WPTaxonomy
{
    public string $name;
    public string $singular;
    public string $plural;
    public string $slug;
    public int $menu_position;
    public array $post_types;

    public function __construct(
        string $name,
        string $singular,
        string $plural,
        string $slug,
        string $menu_position,
        array $post_types
    ) {
        $this->name = $name;
        $this->singular = $singular;
        $this->plural = $plural;
        $this->slug = $slug;
        $this->menu_position = $menu_position;
        $this->post_types = $post_types;
    }

    function getLabels()
    {
        return array(
            'name' => $this->name,
            'singular_name' => $this->singular,
            'search_items' => 'Search ' . $this->plural,
            'add_new_item' => 'Add ' . $this->singular,
            'all_items' => 'All ' . $this->plural,
            'new_item_name' => $this->singular . ' Name',
            'not_found' => $this->singular . ' Not Found',
            'not_found_in_trash' => 'No ' . $this->plural . ' found in trash',
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit ' . $this->singular,
            'update_item' => 'Update ' . $this->singular,
            'add_new_item' => 'Add New ' . $this->singular,
            'add_or_remove_items' => 'Add or remove ' . $this->plural,
            'choose_from_most_used' => 'Choose from most used ' . $this->plural
        );
    }

    function getArgs()
    {
        return array(
            'hierarchical' => false,
            'labels' => $this->getLabels(),
            'show_ui' => true,
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => array(
                'with_front' => false,
                'slug' => $this->slug
            ),
            'menu_position' => $this->menu_position,
            'exclude_from_search' => false,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
        );
    }
}
