<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;
use SEVEN_TECH\Portfolio\Database\DatabaseProject;
use WP_REST_Request;
use WP_Query;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\PortfolioProject;

class Project
{
    private $post_type;
    private $portfolio_project;
    private $project_database;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->portfolio_project = new PortfolioProject;
        $this->project_database = new DatabaseProject;
    }

    public function post_project(WP_REST_Request $request)
    {
        try {
            $project = [
                'client_id' => $request['client_id'],
                'post_id' => $request['post_id'],
                'project_urls' => $request['project_urls'],
                'project_details' => $request['project_details'],
                'project_status' => $request['project_status'],
                'project_versions' => $request['project_versions'],
                'design' => $request['design'],
                'design_check_list' => $request['design_check_list'],
                'colors' => $request['colors'],
                'development' => $request['development'],
                'development_check_list' => $request['development_check_list'],
                'git_repo' => $request['git_repo'],
                'delivery' => $request['delivery'],
                'delivery_check_list' => $request['delivery_check_list'],
                'project_team' => serialize($request['project_team']),
            ];

            $existing_project = $this->project_database->getProject($project['post_id']);

            if ($existing_project) {
                $updated_project = $this->project_database->updateProject($request['post_id'], $project);

                return rest_ensure_response($updated_project, 200);
            } else {
                $project_id = $this->project_database->saveProject($project);

                return rest_ensure_response($project_id);
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

    function get_project_team($team)
    {
        $project_team = [];

        if (isset($team) && is_array($team)) {
            foreach ($team as $member) {
                $user_data = get_userdata($member['id']);

                if ($user_data) {

                    $member = [
                        'id' => $user_data->ID,
                        'first_name' => $user_data->first_name,
                        'last_name' => $user_data->last_name,
                        'email' => $user_data->user_email,
                        'role' => isset($member['role']) ? $member['role'] : '',
                        'author_url' => $user_data->user_url,
                        'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384])
                    ];

                    $project_team[] = $member;
                }
            }
        }

        return $project_team;
    }


    public function get_project(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $args = array(
                'post_type' => $this->post_type,
                'name' => $slug,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $query->the_post();

                $project_id = get_the_ID();

                $project = $this->portfolio_project->getPortfolioProject($project_id);

                return rest_ensure_response($project);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'Project not found',
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

    public function get_project_by_client_id(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $client_id = $request['client_id'];

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $args = array(
                'post_type' => $this->post_type,
                'name' => $slug,
            );

            $query = new WP_Query($args);


            if ($query->have_posts()) {
                $query->the_post();

                $project_id = get_the_ID();

                $project = $this->project_database->getProjectByClientID($project_id, $client_id);

                return rest_ensure_response($project);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'Project not found',
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
