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
        $taxonomies = new Taxonomies;

        register_rest_route('seven-tech/portfolio/v1', '/portfolio/onboarding', [
            'methods' => 'POST',
            'callback' => [$onboarding, 'create_project_onboarding'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/onboarding/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'POST',
            'callback' => [$onboarding, 'get_project_onboarding'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/onboarding/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'PATCH',
            'callback' => [$onboarding, 'update_project_onboarding'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/portfolio/problem/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'POST',
            'callback' => [$problem, 'create_project_problem'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/project/problem/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'POST',
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

        register_rest_route('seven-tech/portfolio/v1', '/portfolio/types', [
            'methods' => 'GET',
            'callback' => [$portfolio, 'get_portfolio_types'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/portfolio/tags', [
            'methods' => 'GET',
            'callback' => [$portfolio, 'get_portfolio_tags'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/portfolio', [
            'methods' => 'POST',
            'callback' => [$project, 'post_project'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$project, 'get_project'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)/id', [
            'methods' => 'POST',
            'callback' => [$project, 'get_project_by_client_id'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/projects/type/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_projects_type'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/projects/tag/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_projects_tag'],
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
