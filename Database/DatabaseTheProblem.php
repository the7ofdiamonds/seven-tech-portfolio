<?php

namespace SEVEN_TECH\Portfolio\Database;

use Exception;

class DatabaseTheProblem
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = 'SEVEN_TECH_Portfolio_project_problem';
    }
    
    public function saveProblem($problem)
    {
        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'post_id' => $problem['post_id'],
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
            ]
        );

        if (!$result) {
            $error_message = $this->wpdb->last_error;
            throw new Exception($error_message);
        }

        $problem_id = $this->wpdb->insert_id;

        return $problem_id;
    }

    public function getProblem($post_id)
    {
        $problem = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE post_id = %d",
                $post_id
            )
        );

        if ($problem === null) {
            return 'Problem not found';
        }

        $problem_data = [
            'id' => $problem->id,
            'post_id' => $problem->post_id,
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

    public function updateProblem($post_id, $problem)
    {
        $data = array(
            'post_id' => $problem->post_id,
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
        );

        $where = array(
            'post_id' => $post_id,
        );

        if (!empty($data)) {
            $updated = $this->wpdb->update($this->table_name, $data, $where);
        }

        if ($updated === false) {

            throw new Exception($this->wpdb->last_error ?: 'Problem not found');
        }

        return $updated;
    }
}
