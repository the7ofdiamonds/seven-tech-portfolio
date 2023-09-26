<?php

namespace THFW_Portfolio\API;

use Exception;
use WP_REST_Request;

use THFW_Portfolio\Database\OnboardingDatabase;
use THFW_Portfolio\Database\TheProblemDatabase;

class Clients
{
    private $onboarding_database;
    private $the_problem_database;

    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/users/client/onboarding', array(
                'methods' => 'POST',
                'callback' => array($this, 'client_onboarding'),
                'permission_callback' => '__return_true',
            ));
        });

        $this->onboarding_database = new OnBoardingDatabase;

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/users/client/problem', array(
                'methods' => 'POST',
                'callback' => array($this, 'client_problem'),
                'permission_callback' => '__return_true',
            ));
        });

        $this->the_problem_database = new TheProblemDatabase;
    }


    function client_onboarding(WP_REST_Request $request)
    {error_log($request['client_id'] . 'client_onboarding');
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

    function client_problem(WP_REST_Request $request)
    {error_log($request['client_id'] . 'client_problem');
        try {
            $problem = [
                'client_id' => $request['client_id'],
                'customers_impacted' => $request['customers_impacted'],
                'primary_stackholders' => $request['primary_stackholders'],
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
