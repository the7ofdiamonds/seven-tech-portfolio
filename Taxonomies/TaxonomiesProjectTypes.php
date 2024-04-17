<?php

namespace SEVEN_TECH\Portfolio\Taxonomies;

use Exception;

use WP_Query;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Portfolio;

class TaxonomiesProjectTypes
{
    public $taxonomies;
    public $portfolio;

    public function __construct()
    {
        $this->taxonomies = new Taxonomies;
        $this->portfolio = new Portfolio;
    }

    public function getProjectTypes($post_type)
    {
        try {
            $project_types = $this->taxonomies->get_post_type_taxonomy($post_type, 'project_types');

            $projectTypes = [];

            foreach ($project_types as $projectType) {
                $projectTypes[] = [
                    'name' => $projectType->name,
                    'icon' => $projectType->slug,
                    'url' => "/project/type/{$projectType->slug}"
                ];
            }

            return $projectTypes;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getProjectType($type)
    {
        try {
            $taxonomy = 'project_types';
            $args = array(
                'post_type' => array('post', 'portfolio'),
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $type,
                    )
                )
            );

            $query = new WP_Query($args);

            $posts = $query->posts;

            $projects = [];

            if (empty($posts)) {
                throw new Exception('No portfolio items found', 400);
            }

            foreach ($posts as $post) {
                $projects[] = $this->portfolio->getPortfolioProject($post->ID, $post->post_title, $post->post_excerpt, "/{$post->post_type}/{$post->post_name}");
            }

            $term = get_term_by('slug', $type, $taxonomy);

            $icon = '';
            $title = '';

            if (is_object($term)) {
                $icon = $term->slug;
                $title = $term->name;
            }

            $projectTypes = [
                'icon' => $icon,
                'title' => $title,
                'projects' => $projects
            ];

            return rest_ensure_response($projectTypes);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
