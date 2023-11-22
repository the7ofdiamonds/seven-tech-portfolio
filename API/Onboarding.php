<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;
use WP_REST_Request;
use WP_Query;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\PortfolioProjectOnboarding;

class Onboarding
{
    private $project_onboarding;

    public function __construct()
    {
        $this->project_onboarding = new PortfolioProjectOnboarding;
    }

    function create_project_onboarding(WP_REST_Request $request)
    {
        try {
            $client_id = $request['client_id'];

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $project_title = $request['project_title'];

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 400);
            }

            $project = get_page_by_title($project_title, OBJECT, 'portfolio');

            if (empty($project)) {
                $project_data = array(
                    'post_title'    => $project_title,
                    'post_status'   => 'pending',
                    'post_author'   => $client_id,
                    'post_type'     => 'portfolio',
                );

                $project_id = wp_insert_post($project_data);

                if (is_wp_error($project_id)) {
                    throw new Exception('Error creating post: ' . $project_id->get_error_message(), 500);
                } else {
                    $post = get_post($project_id);
                    $project_slug = $post->post_name;
                }
            }

            $onboarding = [
                'project_id' => $project_id,
                'project_title' => $project_title,
                'project_slug' => $project_slug,
                'client_id' => $client_id,
                'deadline' => !empty($request['deadline']) ? $request['deadline'] : '',
                'where_business' => !empty($request['where_business']) ? $request['where_business'] : '',
                'website' => !empty($request['website']) ? $request['website'] : '',
                'hosting' => !empty($request['hosting']) ? $request['hosting'] : '',
                'satisfied' => !empty($request['satisfied']) ? $request['satisfied'] : '',
                'signage' => !empty($request['signage']) ? $request['signage'] : '',
                'social_networks' => !empty($request['social_networks']) ? $request['social_networks'] : '',
                'logo' => !empty($request['logo']) ? $request['logo'] : '',
                'colors' => !empty($request['colors']) ? $request['colors'] : '',
                'plan' => !empty($request['plan']) ? $request['plan'] : '',
            ];

            $onboarding_id = $this->project_onboarding->createProjectOnboarding($onboarding);

            return rest_ensure_response($onboarding_id);
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

    function get_project_onboarding(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $page = get_page_by_path($slug, OBJECT, 'portfolio');

            if (empty($page)) {
                throw new Exception("Onboarding for project {$slug} not found.", 404);
            } else {
                $project_id = $page->ID;
            }

            $onboarding = $this->project_onboarding->getProjectOnboarding($project_id);

            return rest_ensure_response($onboarding);
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

    function update_project_onboarding(WP_REST_Request $request)
    {
        try {
            $client_id = $request['client_id'];

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $project_title = $request['project_title'];

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 400);
            }

            $slug = $request->get_param('slug');
            $page = get_page_by_path($slug, OBJECT, 'portfolio');

            if (empty($page)) {
                throw new Exception("Onboarding for project {$slug} not found.", 404);
            } else {
                $project_id = $page->ID;
                $project_slug = $page->post_name;
            }

            $onboarding_data = [
                'project_id' => $project_id,
                'project_title' => $project_title,
                'project_slug' => $project_slug,
                'client_id' => $client_id,
                'deadline' => !empty($request['deadline']) ? $request['deadline'] : '',
                'where_business' => !empty($request['where_business']) ? $request['where_business'] : '',
                'website' => !empty($request['website']) ? $request['website'] : '',
                'hosting' => !empty($request['hosting']) ? $request['hosting'] : '',
                'satisfied' => !empty($request['satisfied']) ? $request['satisfied'] : '',
                'signage' => !empty($request['signage']) ? $request['signage'] : '',
                'social_networks' => !empty($request['social_networks']) ? $request['social_networks'] : '',
                'logo' => !empty($request['logo']) ? $request['logo'] : '',
                'colors' => !empty($request['colors']) ? $request['colors'] : '',
                'plan' => !empty($request['plan']) ? $request['plan'] : '',
            ];

            $onboarding_id = $this->project_onboarding->updateProjectOnboarding($project_id, $onboarding_data);

            return rest_ensure_response($onboarding_id);
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
