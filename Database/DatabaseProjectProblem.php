<?php

namespace SEVEN_TECH\Portfolio\Database;

use Exception;

class DatabaseProjectProblem
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = 'SEVEN_TECH_Portfolio_project_problem';
    }

    function saveProblem($problem)
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

        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'project_id' => $project_id,
                'client_id' => $client_id,
                'customers_impacted' => !empty($problem['customers_impacted']) ? $problem['customers_impacted'] : '',
                'problem_affected' => !empty($problem['problem_affected']) ? $problem['problem_affected'] : '',
                'challenges' => !empty($problem['challenges']) ? $problem['challenges'] : '',
                'affected_operations' => !empty($problem['affected_operations']) ? $problem['affected_operations'] : '',
                'change_event' => !empty($problem['change_event']) ? $problem['change_event'] : '',
                'factors_contributed' => !empty($problem['factors_contributed']) ? $problem['factors_contributed'] : '',
                'patterns_trends' => !empty($problem['patterns_trends']) ? $problem['patterns_trends'] : '',
                'first_notice_date' => !empty($problem['first_notice_date']) ? $problem['first_notice_date'] : '',
                'recurring_issue' => !empty($problem['recurring_issue']) ? $problem['recurring_issue'] : '',
                'tried_solutions' => !empty($problem['tried_solutions']) ? $problem['tried_solutions'] : '',
                'tried_solutions_results' => !empty($problem['tried_solutions_results']) ? $problem['tried_solutions_results'] : '',
                'ideal_resolution' => !empty($problem['ideal_resolution']) ? $problem['ideal_resolution'] : '',
            ]
        );

        if (!$result) {
            throw new Exception('Failed to save the project problem. ' . $this->wpdb->last_error, 500);
        }

        $problem_response =  [
            'id' => $this->wpdb->insert_id,
            'message' => 'Your problem has been saved, and information on a suitable solution will be provided shortly.'
        ];

        return $problem_response;
    }

    function getProblem($project_id)
    {
        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        $problem = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE project_id = %d",
                $project_id
            )
        );

        if (!is_object($problem)) {
            throw new Exception('Project problem could not be found.', 404);
        }

        $problem_data = [
            'id' => $problem->id,
            'project_id' => $problem->project_id,
            'client_id' => $problem->client_id,
            'customers_impacted' => $problem->customers_impacted,
            'problem_affected' => $problem->problem_affected,
            'challenges' => $problem->challenges,
            'affected_operations' => $problem->affected_operations,
            'change_event' => $problem->change_event,
            'factors_contributed' => $problem->factors_contributed,
            'patterns_trends' => $problem->patterns_trends,
            'first_notice_date' => $problem->first_notice_date,
            'recurring_issue' => $problem->recurring_issue,
            'tried_solutions' => $problem->tried_solutions,
            'tried_solutions_results' => $problem->tried_solutions_results,
            'ideal_resolution' => $problem->ideal_resolution,
        ];

        return $problem_data;
    }

    function updateProblem($project_id, $problem)
    {
        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        if (!is_array($problem)) {
            throw new Exception('Invalid project problem Data.', 400);
        }

        $client_id = $problem['client_id'];

        if (empty($client_id)) {
            throw new Exception('Client ID is required.', 400);
        }

        $data = array(
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
        );

        $where = array(
            'project_id' => $project_id,
        );

        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        $updated = $this->wpdb->update($this->table_name, $data, $where);

        if ($updated === false) {
            throw new Exception('Failed to update project problem. ' . $this->wpdb->last_error, 500);
        }

        return 'Project problem updated successfully.';
    }
}
