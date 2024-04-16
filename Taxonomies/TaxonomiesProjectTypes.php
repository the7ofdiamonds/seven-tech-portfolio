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
        $args = array(
            'post_type' => array('post', 'portfolio'),
            'posts_per_page' => 10,
            'tax_query' => array(
                array(
                    'taxonomy' => 'project_types',
                    'field' => 'slug',
                    'terms' => $type,
                )
            )
        );

        $query = new WP_Query($args);
        $projects = [];
        $posts = $query->posts;

        if (is_array($posts) && !empty($posts)) {
            foreach ($posts as $post) {
                $projects[] = $this->portfolio->getPortfolioProject($post->ID, $post->post_title, "/{$post->post_type}/{$post->post_name}");
            }

            return rest_ensure_response($projects);
        } else {
            $status_code = 404;
            $response_data = [
                'message' => 'No portfolio items found',
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
        return $projects;
    }
}
