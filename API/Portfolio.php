<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use SEVEN_TECH\Portfolio\Media\Media;
use SEVEN_TECH\Portfolio\Database\Database;
use SEVEN_TECH\Portfolio\Database\DatabaseProject;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class Portfolio
{
    private $post_type;
    private $media;
    private $project_database;
    private $taxonomies;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->media = new Media;
        $database = new Database;

        $this->project_database = new DatabaseProject($database->project_table);
        $this->taxonomies = new Taxonomies;
    }

    public function get_portfolio()
    {
        try {
            $args = ['post_type' => $this->post_type];

            $query = new WP_Query($args);
            $portfolio = [];
            $posts = $query->posts;

            if (is_array($posts) && !empty($posts)) {
                foreach ($posts as $post) {
                    $project_id = $post->ID;
                    $project = $this->project_database->getProject($project_id);
                    $solution_gallery = $this->media->urls("portfolio/{$project_id}/solution-gallery", 'image/');

                    $project_data = array(
                        'id' => $project_id,
                        'post_status' => get_post_field('post_status', $project_id),
                        'post_date' => get_post_field('post_date', $project_id),
                        'title' => get_the_title($project_id),
                        'post_name' => $post->post_name,
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
            $project_types = $this->taxonomies->get_post_type_taxonomy($this->post_type, 'project_types');

            if ($project_types) {
                return rest_ensure_response($project_types);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'No Project Types found',
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
            $project_types = $this->taxonomies->get_post_type_taxonomy($this->post_type, 'project_tags');

            if ($project_types) {
                return rest_ensure_response($project_types);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'No Project Tags found',
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
