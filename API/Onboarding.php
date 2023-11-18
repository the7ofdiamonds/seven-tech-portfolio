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
                'deadline' => isset($request['deadline']) ? $request['deadline'] : '',
                'deadline_date' => isset($request['deadline_date']) ? $request['deadline_date'] : '',
                'where_business' => isset($request['where_business']) ? $request['where_business'] : '',
                'website' => isset($request['website']) ? $request['website'] : '',
                'website_url' => isset($request['website_url']) ? $request['website_url'] : '',
                'hosting' => isset($request['hosting']) ? $request['hosting'] : '',
                'satisfied' => isset($request['satisfied']) ? $request['satisfied'] : '',
                'signage' => isset($request['signage']) ? $request['signage'] : '',
                'signage_url' => isset($request['signage_url']) ? $request['signage_url'] : '',
                'social' => isset($request['social']) ? $request['social'] : '',
                'social_facebook' => isset($request['social_facebook']) ? $request['social_facebook'] : '',
                'social_x' => isset($request['social_x']) ? $request['social_x'] : '',
                'social_linkedin' => isset($request['social_linkedin']) ? $request['social_linkedin'] : '',
                'social_instagram' => isset($request['social_instagram']) ? $request['social_instagram'] : '',
                'logo' => isset($request['logo']) ? $request['logo'] : '',
                'logo_url' => isset($request['logo_url']) ? $request['logo_url'] : '',
                'colors' => isset($request['colors']) ? $request['colors'] : '',
                'colors_primary' => isset($request['colors_primary']) ? $request['colors_primary'] : '',
                'colors_secondary' => isset($request['colors_secondary']) ? $request['colors_secondary'] : '',
                'colors_tertiary' => isset($request['colors_tertiary']) ? $request['colors_tertiary'] : '',
                'summary' => isset($request['summary']) ? $request['summary'] : '',
                'summary_url' => isset($request['summary_url']) ? $request['summary_url'] : '',
                'plan' => isset($request['plan']) ? $request['plan'] : '',
                'plan_url' => isset($request['plan_url']) ? $request['plan_url'] : '',
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
                'pagename' => $slug,
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
                    'deadline' => isset($request['deadline']) ? $request['deadline'] : '',
                    'deadline_date' => isset($request['deadline_date']) ? $request['deadline_date'] : '',
                    'where_business' => isset($request['where_business']) ? $request['where_business'] : '',
                    'website' => isset($request['website']) ? $request['website'] : '',
                    'website_url' => isset($request['website_url']) ? $request['website_url'] : '',
                    'hosting' => isset($request['hosting']) ? $request['hosting'] : '',
                    'satisfied' => isset($request['satisfied']) ? $request['satisfied'] : '',
                    'signage' => isset($request['signage']) ? $request['signage'] : '',
                    'signage_url' => isset($request['signage_url']) ? $request['signage_url'] : '',
                    'social' => isset($request['social']) ? $request['social'] : '',
                    'social_facebook' => isset($request['social_facebook']) ? $request['social_facebook'] : '',
                    'social_x' => isset($request['social_x']) ? $request['social_x'] : '',
                    'social_linkedin' => isset($request['social_linkedin']) ? $request['social_linkedin'] : '',
                    'social_instagram' => isset($request['social_instagram']) ? $request['social_instagram'] : '',
                    'logo' => isset($request['logo']) ? $request['logo'] : '',
                    'logo_url' => isset($request['logo_url']) ? $request['logo_url'] : '',
                    'colors' => isset($request['colors']) ? $request['colors'] : '',
                    'colors_primary' => isset($request['colors_primary']) ? $request['colors_primary'] : '',
                    'colors_secondary' => isset($request['colors_secondary']) ? $request['colors_secondary'] : '',
                    'colors_tertiary' => isset($request['colors_tertiary']) ? $request['colors_tertiary'] : '',
                    'summary' => isset($request['summary']) ? $request['summary'] : '',
                    'summary_url' => isset($request['summary_url']) ? $request['summary_url'] : '',
                    'plan' => isset($request['plan']) ? $request['plan'] : '',
                    'plan_url' => isset($request['plan_url']) ? $request['plan_url'] : '',
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
