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

        register_rest_route('seven-tech/portfolio/v1', '/project/problem', [
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

        register_rest_route('seven-tech/portfolio/v1', '/projects', [
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

        register_rest_route('seven-tech/portfolio/v1', '/projects/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$project, 'get_project'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/projects/client/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'POST',
            'callback' => [$project, 'get_project_by_client_id'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/project-types', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_project_types'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_skills'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/frameworks', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_frameworks'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/technologies', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_technologies'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/project-types/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_project_type'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/skills/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_skill'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/frameworks/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_framework'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('seven-tech/portfolio/v1', '/taxonomies/technologies/(?P<slug>[a-zA-Z0-9-_]+)', [
            'methods' => 'GET',
            'callback' => [$taxonomies, 'get_technology'],
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
