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

            $onboarding = [
                'project_title' => $project_title,
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
            $args = array(
                'post_type' => 'portfolio',
                'post_name' => $slug,
                'posts_per_page' => 1,
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $project = $query->posts[0];

                $onboarding = $this->project_onboarding->getProjectOnboarding($project->ID);

                return rest_ensure_response($onboarding);
            } else {
                return rest_ensure_response("Onboarding for project {$slug} not found");
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

    function update_project_onboarding(WP_REST_Request $request)
    {
        try {
            $client_id = $request['client_id'];

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $slug = $request->get_param('slug');
            $args = array(
                'post_type' => 'portfolio',
                'pagename' => $slug,
                'posts_per_page' => 1,
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $project = $query->posts[0];

                $onboarding_data = [
                    'project_id' => $project->ID,
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

                $onboarding_id = $this->project_onboarding->updateProjectOnboarding($client_id, $onboarding_data);

                return rest_ensure_response($onboarding_id);
            } else {
                return rest_ensure_response("Onboarding for project {$slug} not found");
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
