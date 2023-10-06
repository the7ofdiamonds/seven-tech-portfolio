<?php

namespace THFW_Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use THFW_Portfolio\Post_Types\PortfolioUploads;
use THFW_Portfolio\Database\DatabaseProject;

class Taxonomies
{
    private $post_type;
    private $portfolio_uploads;
    private $project_database;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->portfolio_uploads = new PortfolioUploads;
        $this->project_database = new DatabaseProject;

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/projects/type/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_projects_type'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/projects/tag/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_projects_tag'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function get_projects_type(WP_REST_Request $request)
    {
        $slug = $request->get_param('slug');

        $args = array(
            'post_type' => array('post', $this->post_type),
            'posts_per_page' => 10,
            'tax_query' => array(
                array(
                    'taxonomy' => 'project_types',
                    'field' => 'slug',
                    'terms' => $slug,
                )
            )
        );

        $query = new WP_Query($args);
        $projects = [];
        $posts = $query->posts;

        if (is_array($posts) && !empty($posts)) {
            foreach ($posts as $post) {
                $project_id = $post->ID;
                $project = $this->project_database->getProject($project_id);
                $solution_gallery = $this->portfolio_uploads->getPhotos(get_the_title($project_id), 'solution');

                $project_data = array(
                    'id' => $project_id,
                    'post_status' => get_post_field('post_status', $project_id),
                    'post_date' => get_post_field('post_date', $project_id),
                    'title' => get_the_title($project_id),
                    'solution_gallery' => !empty($solution_gallery) ? $solution_gallery : '',
                    'project_status' => $project === 'Status not available' ? '0' : (isset($project['project_status']) ? $project['project_status'] : '0'),
                );

                $projects[] = $project_data;
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

    public function get_projects_tag(WP_REST_Request $request)
    {
        $slug = $request->get_param('slug');

        $args = array(
            'post_type' => array('post', $this->post_type),
            'posts_per_page' => 10,
            'tax_query' => array(
                array(
                    'taxonomy' => 'project_tags',
                    'field' => 'slug',
                    'terms' => $slug,
                )
            )
        );

        $query = new WP_Query($args);
        $projects = [];
        $posts = $query->posts;

        if (is_array($posts) && !empty($posts)) {
            foreach ($posts as $post) {
                $project_id = $post->ID;
                $project = $this->project_database->getProject($project_id);
                $solution_gallery = $this->portfolio_uploads->getPhotos(get_the_title($project_id), 'solution');

                $project_data = array(
                    'id' => $project_id,
                    'post_status' => get_post_field('post_status', $project_id),
                    'post_date' => get_post_field('post_date', $project_id),
                    'title' => get_the_title($project_id),
                    'solution_gallery' => !empty($solution_gallery) ? $solution_gallery : '',
                    'project_status' => $project === 'Status not available' ? '0' : (isset($project['project_status']) ? $project['project_status'] : '0'),
                );

                $projects[] = $project_data;
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
