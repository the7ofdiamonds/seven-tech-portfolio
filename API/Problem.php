<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;
use WP_REST_Request;
use WP_Query;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\PortfolioProjectProblem;

class Problem
{
    private $project_problem;

    public function __construct()
    {
        $this->project_problem = new PortfolioProjectProblem;
    }

    function create_project_problem(WP_REST_Request $request)
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

                $problem = [
                    'project_id' => $project->ID,
                    'client_id' => $client_id,
                    'customers_impacted' => isset($request['customers_impacted']) ? $request['customers_impacted'] : '',
                    'problem_affected' => isset($request['problem_affected']) ? $request['problem_affected'] : '',
                    'challenges' => isset($request['challenges']) ? $request['challenges'] : '',
                    'affected_operations' => isset($request['affected_operations']) ? $request['affected_operations'] : '',
                    'change_event' => isset($request['change_event']) ? $request['change_event'] : '',
                    'factors_contributed' => isset($request['factors_contributed']) ? $request['factors_contributed'] : '',
                    'patterns_trends' => isset($request['patterns_trends']) ? $request['patterns_trends'] : '',
                    'first_notice_date' => isset($request['first_notice_date']) ? $request['first_notice_date'] : '',
                    'recurring_issue' => isset($request['recurring_issue']) ? $request['recurring_issue'] : '',
                    'tried_solutions' => isset($request['tried_solutions']) ? $request['tried_solutions'] : '',
                    'tried_solutions_results' => isset($request['tried_solutions_results']) ? $request['tried_solutions_results'] : '',
                    'ideal_resolution' => isset($request['ideal_resolution']) ? $request['ideal_resolution'] : '',
                ];

                $problem_id = $this->project_problem->createProjectProblem($problem);

                return rest_ensure_response($problem_id);
            } else {
                return rest_ensure_response("Problem definition for project {$slug} could not found");
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

    function get_project_problem(WP_REST_Request $request)
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

                $projectProblem = $this->project_problem->getProjectProblem($project->ID);

                return rest_ensure_response($projectProblem);
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

    function update_project_problem(WP_REST_Request $request)
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

                $problem = [
                    'project_id' => $project->ID,
                    'client_id' => $client_id,
                    'customers_impacted' => isset($request['customers_impacted']) ? $request['customers_impacted'] : '',
                    'problem_affected' => isset($request['problem_affected']) ? $request['problem_affected'] : '',
                    'challenges' => isset($request['challenges']) ? $request['challenges'] : '',
                    'affected_operations' => isset($request['affected_operations']) ? $request['affected_operations'] : '',
                    'change_event' => isset($request['change_event']) ? $request['change_event'] : '',
                    'factors_contributed' => isset($request['factors_contributed']) ? $request['factors_contributed'] : '',
                    'patterns_trends' => isset($request['patterns_trends']) ? $request['patterns_trends'] : '',
                    'first_notice_date' => isset($request['first_notice_date']) ? $request['first_notice_date'] : '',
                    'recurring_issue' => isset($request['recurring_issue']) ? $request['recurring_issue'] : '',
                    'tried_solutions' => isset($request['tried_solutions']) ? $request['tried_solutions'] : '',
                    'tried_solutions_results' => isset($request['tried_solutions_results']) ? $request['tried_solutions_results'] : '',
                    'ideal_resolution' => isset($request['ideal_resolution']) ? $request['ideal_resolution'] : '',
                ];

                $projectProblem = $this->project_problem->updateProjectProblem($project->ID, $problem);

                return rest_ensure_response($projectProblem);
            } else {
                return rest_ensure_response("Problem definition for project {$slug} could not found");
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