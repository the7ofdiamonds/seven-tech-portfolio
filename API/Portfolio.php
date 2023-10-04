<?php

namespace THFW_Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use THFW_Portfolio\Post_Types\PortfolioUploads;
use THFW_Portfolio\Database\DatabaseProject;
use THFW_Portfolio\Database\DatabaseTeam;
use THFW_Portfolio\Database\DatabaseOnboarding;
use THFW_Portfolio\Database\DatabaseTheProblem;

use THFW_Portfolio\Database\OnboardingDatabase;
use THFW_Portfolio\Database\TheProblemDatabase;

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
    }

    public function get_portfolio()
    {
        try {
            $args = array(
                'post_type' => $this->post_type,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $portfolio = array();

                while ($query->have_posts()) {
                    $query->the_post();
                    $project_id = get_the_ID();
                    $project = $this->project_database->getProject($project_id);

                    $project_data = array(
                        'id' => $project_id,
                        'post_status' => get_post_field('post_status', $project_id),
                        'post_date' => get_post_field('post_date', $project_id),
                        'title' => get_the_title($project_id),
                        'solution_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'solution'),
                        'project_status' => $project['project_status'],
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
}
