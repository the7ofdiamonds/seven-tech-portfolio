<?php

namespace THFW_Portfolio\API;

use Exception;

use WP_Query;

use THFW_Portfolio\Post_Types\PortfolioUploads;
use THFW_Portfolio\Database\DatabaseProject;

class Portfolio
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
            register_rest_route('thfw/v1', '/portfolio', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_portfolio'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/portfolio/types', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_portfolio_types'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/portfolio/tags', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_portfolio_tags'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function get_portfolio()
    {
        try {
            $args = array(
                'post_type' => $this->post_type,
            );

            $query = new WP_Query($args);
            $portfolio = [];
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

                    $portfolio[] = $project_data;
                }

                return rest_ensure_response($portfolio);
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
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }

    public function get_portfolio_types()
    {
        try {
            $project_types = [];

            $terms = get_terms(array(
                'taxonomy'   => 'project_types',
            ));

            if ($terms) {
                foreach ($terms as $term) {
                    $project_type = [
                        'name' => $term->name,
                        'slug' => get_term_link($term)
                    ];

                    $project_types[] = $project_type;
                }

                return rest_ensure_response($project_types);
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
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }

    public function get_portfolio_tags()
    {
        try {
            $project_tags = [];

            $post_tags = get_terms(array(
                'taxonomy'   => 'project_tags',
            ));

            if ($post_tags) {
                foreach ($post_tags as $tag) {
                    $project_tag = [
                        'name' => $tag->name,
                        'slug' => get_tag_link($tag->term_id)
                    ];

                    $project_tags[] = $project_tag;
                }

                return rest_ensure_response($project_tags);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'No tags found',
                    'status' => $status_code
                ];

                $response = rest_ensure_response($response_data);
                $response->set_status($status_code);

                return $response;
            }
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }
}
