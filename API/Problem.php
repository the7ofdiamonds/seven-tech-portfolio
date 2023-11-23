<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;
use WP_REST_Request;

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
            $page = get_page_by_path($slug, OBJECT, 'portfolio');

            if (empty($page)) {
                throw new Exception("Problem definition for project {$slug} could not found.", 404);
            } else {
                $project_id = $page->ID;
            }

            $problem = [
                'project_id' => $project_id,
                'client_id' => $client_id,
                'customers_impacted' => !empty($request['customers_impacted']) ? $request['customers_impacted'] : '',
                'problem_affected' => !empty($request['problem_affected']) ? $request['problem_affected'] : '',
                'challenges' => !empty($request['challenges']) ? $request['challenges'] : '',
                'affected_operations' => !empty($request['affected_operations']) ? $request['affected_operations'] : '',
                'change_event' => !empty($request['change_event']) ? $request['change_event'] : '',
                'factors_contributed' => !empty($request['factors_contributed']) ? $request['factors_contributed'] : '',
                'patterns_trends' => !empty($request['patterns_trends']) ? $request['patterns_trends'] : '',
                'first_notice_date' => !empty($request['first_notice_date']) ? $request['first_notice_date'] : '',
                'recurring_issue' => !empty($request['recurring_issue']) ? $request['recurring_issue'] : '',
                'tried_solutions' => !empty($request['tried_solutions']) ? $request['tried_solutions'] : '',
                'tried_solutions_results' => !empty($request['tried_solutions_results']) ? $request['tried_solutions_results'] : '',
                'ideal_resolution' => !empty($request['ideal_resolution']) ? $request['ideal_resolution'] : '',
            ];

            $problem_id = $this->project_problem->createProjectProblem($problem);

            return rest_ensure_response($problem_id);
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
            $page = get_page_by_path($slug, OBJECT, 'portfolio');

            if (empty($page)) {
                throw new Exception("Problem definition for project {$slug} could not found.", 404);
            } else {
                $project_id = $page->ID;
            }

            $projectProblem = $this->project_problem->getProjectProblem($project_id);

            return rest_ensure_response($projectProblem);
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
            $page = get_page_by_path($slug, OBJECT, 'portfolio');

            if (empty($page)) {
                throw new Exception("Problem definition for project {$slug} could not found", 404);
            } else {
                $project_id = $page->ID;
            }

            $problem = [
                'project_id' => $project_id,
                'client_id' => $client_id,
                'customers_impacted' => !empty($request['customers_impacted']) ? $request['customers_impacted'] : '',
                'problem_affected' => !empty($request['problem_affected']) ? $request['problem_affected'] : '',
                'challenges' => !empty($request['challenges']) ? $request['challenges'] : '',
                'affected_operations' => !empty($request['affected_operations']) ? $request['affected_operations'] : '',
                'change_event' => !empty($request['change_event']) ? $request['change_event'] : '',
                'factors_contributed' => !empty($request['factors_contributed']) ? $request['factors_contributed'] : '',
                'patterns_trends' => !empty($request['patterns_trends']) ? $request['patterns_trends'] : '',
                'first_notice_date' => !empty($request['first_notice_date']) ? $request['first_notice_date'] : '',
                'recurring_issue' => !empty($request['recurring_issue']) ? $request['recurring_issue'] : '',
                'tried_solutions' => !empty($request['tried_solutions']) ? $request['tried_solutions'] : '',
                'tried_solutions_results' => !empty($request['tried_solutions_results']) ? $request['tried_solutions_results'] : '',
                'ideal_resolution' => !empty($request['ideal_resolution']) ? $request['ideal_resolution'] : '',
            ];

            $projectProblem = $this->project_problem->updateProjectProblem($project_id, $problem);

            return rest_ensure_response($projectProblem);
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
