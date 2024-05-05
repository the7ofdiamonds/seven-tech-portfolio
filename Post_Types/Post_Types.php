<?php

namespace SEVEN_TECH\Portfolio\Post_Types;

use Exception;

use  WP_Query;

use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class Post_Types
{
    public $post_types_list;

    public function __construct()
    {
        $taxonomies = (new Taxonomies)->getTaxonomyNames();
        $this->post_types_list = [
            [
                'name' => 'portfolio',
                'menu_icon' => '',
                'menu_position' => 15,
                'title' => 'PORTFOLIO',
                'singular' => 'Project',
                'plural' => 'Portfolio',
                'archive_page' => 'Portfolio',
                'single_page' => 'Project',
                'slug' => 'portfolio',
                'dir' => 'Portfolio',
                'taxonomies' => $taxonomies
            ],
        ];
    }

    function customPostTypes()
    {
        if (is_array($this->post_types_list)) {
            foreach ($this->post_types_list as $post_type) {
                $labels = array(
                    'name' => $post_type['title'],
                    'singular_name' => $post_type['singular'],
                    'add_new' => 'Add ' . $post_type['singular'],
                    'all_items' => $post_type['plural'],
                    'add_new_item' => 'Add New ' . $post_type['singular'],
                    'edit_item' => 'Edit ' . $post_type['singular'],
                    'new_item' => 'New ' . $post_type['singular'],
                    'view_item' => 'View ' . $post_type['singular'],
                    'search_item' => 'Search ' . $post_type['plural'],
                    'not_found' => 'No ' . $post_type['plural'] . ' Found',
                    'not_found_in_trash' => 'No ' . $post_type['singular'] . ' found in trash',
                    'parent_item_colon' => 'Parent ' . $post_type['singular']
                );

                $args = array(
                    'labels' => $labels,
                    'show_ui' => true,
                    'menu_icon' => $post_type['menu_icon'],
                    'show_in_rest' => true,
                    'show_in_nav_menus' => true,
                    'public' => true,
                    'has_archive' => true,
                    'publicly_queryable' => true,
                    'query_var' => true,
                    'rewrite' => array(
                        'with_front' => false,
                        'slug'       => $post_type['slug']
                    ),
                    'hierarchical' => true,
                    'supports' => [
                        'title',
                        'author',
                        'editor',
                        'excerpt',
                        'thumbnail',
                        'custom-fields',
                        'revisions',
                        'page-attributes',
                    ],
                    'taxonomies' => $post_type['taxonomies'],
                    'menu_position' => $post_type['menu_position'],
                    'exclude_from_search' => false
                );

                register_post_type($post_type['name'], $args);
            }
        }
    }

    function getPostTypeWithTerm($post_type, $taxonomy, $term)
    {
        $args = array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $term
                )
            ),
        );

        $query = new WP_Query($args);
        $posts = $query->posts;

        if (empty($posts)) {
            return '';
        }

        return $posts;
    }

    public function getPostTypesByUser($nicename, $postTypes)
    {
        try {
            $user = get_user_by('slug', $nicename);

            if (empty($user)) {
                throw new Exception('User could not be found.', 404);
            }

            $args = array(
                'post_type'      => $postTypes,
                'author'         => $user->ID,
                'posts_per_page' => -1,
            );

            $query = new WP_Query($args);

            $post_types = $query->posts;

            if (empty($post_types)) {
                return '';
            }

            return $post_types;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getPostTypesByTaxonomy($taxonomy, $postType)
    {
        try {
            if (!taxonomy_exists($taxonomy)) {
                throw new Exception('Taxonomy does not exists.', 404);
            }

            if (!post_type_exists($postType)) {
                throw new Exception('Post type does not exists.', 404);
            }

            $args = array(
                'post_type' => $postType,
                'posts_per_page' => -1,
            );

            $query = new WP_Query($args);

            $posts = $query->posts;

            if (empty($posts)) {
                return '';
            }

            $post_types = [];

            foreach ($posts as $post) {
                $terms = wp_get_post_terms($post->ID, $taxonomy);

                if (!empty($terms)) {
                    $post_types[] = $post;
                }
            }

            return $post_types;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
