<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;
use WP_REST_Request;

use SEVEN_TECH\Portfolio\Database\Database;
use SEVEN_TECH\Portfolio\Database\DatabaseOnboarding;
use SEVEN_TECH\Portfolio\Database\DatabaseTheProblem;

class Clients
{
    private $onboarding_database;
    private $the_problem_database;

    public function __construct()
    {
        $database = new Database;

        $this->onboarding_database = new DatabaseOnboarding($database->project_onboarding_table);

        $this->the_problem_database = new DatabaseTheProblem($database->project_problem_table);
    }


    function create_project_onboarding(WP_REST_Request $request)
    {
        try {
            $onboarding = [
                'client_id' => $request['client_id'],
                'deadline' => $request['deadline'],
                'deadline_date' => $request['deadline_date'],
                'where_business' => $request['where_business'],
                'website' => $request['website'],
                'website_url' => $request['website_url'],
                'hosting' => $request['hosting'],
                'satisfied' => $request['satisfied'],
                'signage' => $request['signage'],
                'signage_url' => $request['signage_url'],
                'social' => $request['social'],
                'social_facebook' => $request['social_facebook'],
                'social_x' => $request['social_x'],
                'social_linkedin' => $request['social_linkedin'],
                'social_instagram' => $request['social_instagram'],
                'logo' => $request['logo'],
                'logo_url' => $request['logo_url'],
                'colors' => $request['colors'],
                'colors_primary' => $request['colors_primary'],
                'colors_secondary' => $request['colors_secondary'],
                'colors_tertiary' => $request['colors_tertiary'],
                'summary' => $request['summary'],
                'summary_url' => $request['summary_url'],
                'plan' => $request['plan'],
                'plan_url' => $request['plan_url'],
            ];

            $onboarding_id = $this->onboarding_database->saveOnboarding($onboarding);
            return rest_ensure_response($onboarding_id);
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

    function create_project_problem(WP_REST_Request $request)
    {
        try {
            $problem = [
                'client_id' => $request['client_id'],
                'customers_impacted' => $request['customers_impacted'],
                'problem_affected' => $request['problem_affected'],
                'challenges' => $request['challenges'],
                'affected_operations' => $request['affected_operations'],
                'change_event' => $request['change_event'],
                'factors_contributed' => $request['factors_contributed'],
                'patterns_trends' => $request['patterns_trends'],
                'first_notice_date' => $request['first_notice_date'],
                'recurring_issue' => $request['recurring_issue'],
                'tried_solutions' => $request['tried_solutions'],
                'tried_solutions_results' => $request['tried_solutions_results'],
                'ideal_resolution' => $request['ideal_resolution'],
            ];

            $problem_id = $this->the_problem_database->saveProblem($problem);
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
