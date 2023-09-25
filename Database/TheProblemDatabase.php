<?php

namespace THFW_Portfolio\Database;

use Exception;

class TheProblemDatabase
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = '7tech_problem';
    }

    public function saveProblem($problem)
    {
        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'client_id' => $problem['client_id'],
                'customers_impacted' => $problem['customers_impacted'],
                'primary_stackholders' => $problem['primary_stackholders'],
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

    public function getProblem($client_id)
    {
        $onboarding = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE client_id = %d",
                $client_id
            )
        );

        if ($onboarding === null) {
            return rest_ensure_response('Problem not found');
        }

        $onboarding_data = [
            'id' => $onboarding->id,
            'client_id' => $onboarding->client_id,
            'deadline' => $onboarding->deadline,
            'deadline_date' => $onboarding->deadline_date,
            'where_business' => $onboarding->where_business,
            'website' => $onboarding->website,
            'website_url' => $onboarding->website_url,
            'hosting' => $onboarding->hosting,
            'satisfied' => $onboarding->satisfied,
            'signage' => $onboarding->signage,
            'signage_url' => $onboarding->signage_url,
            'social' => $onboarding->social,
            'social_facebook' => $onboarding->social_facebook,
            'social_x' => $onboarding->social_x,
            'social_linkedin' => $onboarding->social_linkedin,
            'social_instagram' => $onboarding->social_instagram,
            'logo' => $onboarding->logo,
            'logo_url' => $onboarding->logo_url,
            'colors' => $onboarding->colors,
            'colors_primary' => $onboarding->colors_primary,
            'colors_secondary' => $onboarding->colors_secondary,
            'colors_tertiary' => $onboarding->colors_tertiary,
            'summary' => $onboarding->summary,
            'summary_url' => $onboarding->summary_url,
            'what_business' => $onboarding->what_business,
            'plan' => $onboarding->plan,
            'plan_url' => $onboarding->plan_url,
        ];

        return $onboarding_data;
    }

    public function updateProblem($client_id, $onboarding)
    {
        $data = array(
            'client_id' => $onboarding->client_id,
            'deadline' => $onboarding->deadline,
            'deadline_date' => $onboarding->deadline_date,
            'where_business' => $onboarding->where_business,
            'website' => $onboarding->website,
            'website_url' => $onboarding->website_url,
            'hosting' => $onboarding->hosting,
            'satisfied' => $onboarding->satisfied,
            'signage' => $onboarding->signage,
            'signage_url' => $onboarding->signage_url,
            'social' => $onboarding->social,
            'social_facebook' => $onboarding->social_facebook,
            'social_x' => $onboarding->social_x,
            'social_linkedin' => $onboarding->social_linkedin,
            'social_instagram' => $onboarding->social_instagram,
            'logo' => $onboarding->logo,
            'logo_url' => $onboarding->logo_url,
            'colors' => $onboarding->colors,
            'colors_primary' => $onboarding->colors_primary,
            'colors_secondary' => $onboarding->colors_secondary,
            'colors_tertiary' => $onboarding->colors_tertiary,
            'summary' => $onboarding->summary,
            'summary_url' => $onboarding->summary_url,
            'what_business' => $onboarding->what_business,
            'plan' => $onboarding->plan,
            'plan_url' => $onboarding->plan_url,
        );

        $where = array(
            'client_id' => $client_id,
        );

        if (!empty($data)) {
            $updated = $this->wpdb->update($this->table_name, $data, $where);
        }

        if ($updated === false) {
            $error_message = $this->wpdb->last_error ?: 'Problem not found';
            $response = rest_ensure_response($error_message);
            $response->set_status(404);

            return $response;
        }

        return $updated;
    }
}
