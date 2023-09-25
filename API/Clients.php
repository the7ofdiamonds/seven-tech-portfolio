<?php

namespace THFW_Portfolio\API;

use Exception;
use WP_REST_Request;

use THFW_Portfolio\Database\OnboardingDatabase;

class Clients
{
    private $onboarding_database;

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
    }


    function client_onboarding(WP_REST_Request $request)
    {
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
            'what_business' => $request['what_business'],
            'plan' => $request['plan'],
            'plan_url' => $request['plan_url'],
        ];

        return $this->onboarding_database->saveOnboarding($onboarding);
    }
}
