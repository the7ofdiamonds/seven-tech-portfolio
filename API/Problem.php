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
            $problem = [
                'project_id' => isset($request['project_id']) ? $request['project_id'] : '',
                'client_id' => isset($request['client_id']) ? $request['client_id'] : '',
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
