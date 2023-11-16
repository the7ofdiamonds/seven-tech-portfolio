<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use SEVEN_TECH\Portfolio\Database\DatabaseProjectProblem;

use Exception;

class PortfolioProjectProblem
{
    private $project_problem;

    public function __construct()
    {
        $this->project_problem = new DatabaseProjectProblem;
    }

    function createProjectProblem($problem)
    {
        try {
            $problem_data = [
                'client_id' => $problem['client_id'],
                'customers_impacted' => $problem['customers_impacted'],
                'problem_affected' => $problem['problem_affected'],
                'challenges' => $problem['challenges'],
                'affected_operations' => $problem['affected_operations'],
                'change_event' => $problem['change_event'],
                'factors_contributed' => $problem['factors_contributed'],
                'patterns_trends' => $problem['patterns_trends'],
                'first_notice_date' => $problem['first_notice_date'],
                'recurring_issue' => $problem['recurring_issue'],
                'tried_solutions' => $problem['tried_solutions'],
                'tried_solutions_results' => $problem['tried_solutions_results'],
                'ideal_resolution' => $problem['ideal_resolution'],
            ];

            $problem_id = $this->project_problem->saveProblem($problem_data);
            return $problem_id;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            return $response;
        }
    }
}
