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

    protected function saveProblem($problem)
    {
        try {
            if (!is_array($problem)) {
                throw new Exception('Project problem data is needed to save to the database.', 400);
            }

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
                throw new Exception('Unable to save the project problem. ' . $this->wpdb->last_error, 500);
            }

            return $this->wpdb->insert_id;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at saveProblem');

            return $response;
        }
    }

    protected function getProblem($post_id)
    {
        try {
            if (empty($post_id)) {
                throw new Exception('Post ID is required.', 400);
            }

            $problem = $this->wpdb->get_row(
                $this->wpdb->prepare(
                    "SELECT * FROM {$this->table_name} WHERE post_id = %d",
                    $post_id
                )
            );

            if (!is_object($problem)) {
                throw new Exception('Project problem not found', 404);
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
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getProblem');

            return $response;
        }
    }

    protected function updateProblem($post_id, $problem)
    {
        try {
            if (empty($post_id)) {
                throw new Exception('Post ID is required.', 400);
            }

            if (!is_object($problem)) {
                throw new Exception('Invalid Project Data', 400);
            }

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
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at updateProblem');

            return $response;
        }
    }
}
