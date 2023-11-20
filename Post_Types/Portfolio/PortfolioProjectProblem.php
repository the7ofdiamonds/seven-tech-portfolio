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
        if (!is_array($problem)) {
            throw new Exception('Project problem data is needed to save to the database.', 400);
        }

        $project_id = $problem['project_id'];
        $client_id = $problem['client_id'];

        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        if (empty($client_id)) {
            throw new Exception('Client ID is required.', 400);
        }

        $problem_data = [
            'project_id' => $project_id,
            'client_id' => $client_id,
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
    }

    function getProjectProblem($project_id)
    {
        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        $problem = $this->project_problem->getProblem($project_id);

        return $problem;
    }

    function updateProjectProblem($project_id, $problem)
    {
        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        if (!is_array($problem)) {
            throw new Exception('Invalid Project problem Data', 400);
        }

        $projectProblem = $this->project_problem->updateProblem($project_id, $problem);

        return $projectProblem;
    }
}
