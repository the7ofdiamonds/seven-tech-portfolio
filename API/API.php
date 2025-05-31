<?php

namespace SEVEN_TECH\Portfolio\API;

class API
{
    public function __construct()
    {
        $onboarding = new Onboarding;
        $portfolio = new Portfolio;
        $problem = new Problem;
        $project = new Project;
        $taxonomies = new Skills;

        register_rest_route('seven-tech/portfolio/v1', '/project/onboarding', [
            'methods' => 'POST',
            'callback' => [$onboarding, 'create_project_onboarding'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/onboarding/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$onboarding, 'get_project_onboarding'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/onboarding/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'PUT',
            'callback' => [$onboarding, 'update_project_onboarding'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/problem', [
            'methods' => 'POST',
            'callback' => [$problem, 'create_project_problem'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/problem/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$problem, 'get_project_problem'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/problem/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'PUT',
            'callback' => [$problem, 'update_project_problem'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/portfolio', [
            'methods' => 'GET',
            'callback' => [$portfolio, 'get_portfolio'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/projects/user/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$portfolio, 'get_portfolio_by_user'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/projects/taxonomies/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$portfolio, 'get_portfolio_by_taxonomy'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/projects/taxonomies/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'POST',
            'callback' => [$portfolio, 'get_portfolio_with_term'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$project, 'get_project'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/projects/client/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'POST',
            'callback' => [$project, 'get_project_by_client_id'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills', [
            'methods' => 'POST',
            'callback' => [$taxonomies, 'add_skill'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills/(?P<tax>[a-zA-Z0-9-_]+)/(?P<term>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_skill'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills/(?P<tax>[a-zA-Z0-9_-]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_skill_type'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_skills'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills/(?P<tax>[a-zA-Z0-9-_]+)/(?P<term>[a-zA-Z0-9-_]+)', [
            'methods' => 'PUT',
            'callback' => [$taxonomies, 'update_skill'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills/(?P<tax>[a-zA-Z0-9-_]+)/(?P<term>[a-zA-Z0-9-_]+)', [
            'methods' => 'DELETE',
            'callback' => [$taxonomies, 'delete_skill'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function allow_cors_headers()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
    }
}
