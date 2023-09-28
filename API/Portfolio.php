<?php

namespace THFW_Portfolio\API;

use Exception;
use WP_REST_Request;

use THFW_Portfolio\Database\OnboardingDatabase;
use THFW_Portfolio\Database\TheProblemDatabase;

class Portfolio
{
    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/users/client/onboarding', array(
                'methods' => 'POST',
                'callback' => array($this, 'client_onboarding'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/users/client/problem', array(
                'methods' => 'POST',
                'callback' => array($this, 'client_problem'),
                'permission_callback' => '__return_true',
            ));
        });
    }
}
