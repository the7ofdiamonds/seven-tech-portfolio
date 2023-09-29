<?php

namespace THFW_Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use THFW_Portfolio\Database\DatabaseProject;
use THFW_Portfolio\Database\DatabaseOnboarding;
use THFW_Portfolio\Database\DatabaseTheProblem;

class Project
{
    private $post_type;
    private $project_database;
    private $onboarding_database;
    private $theproblem_database;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->project_database = new DatabaseProject;
        $this->onboarding_database = new DatabaseOnboarding;
        $this->theproblem_database = new DatabaseTheProblem;

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_project'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function get_project(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $args = array(
                'post_type' => $this->post_type,
                'name' => $slug,
                'posts_per_page' => 1,
            );

            $query = new WP_Query($args);
            $project_id = 1;
            $onboarding = $this->onboarding_database->getOnboarding($project_id);
            $the_problem = $this->theproblem_database->getProblem(14);
            $post_author = get_post_field('post_author', get_the_ID());

            if ($query->have_posts()) {
                $query->the_post();
                $post_data = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'post_status' => get_post_field('post_status', get_the_ID()),
                    'post_date' => get_post_field('post_date', get_the_ID()),
                    'post_content' => get_post_field('post_content', get_the_ID()),
                    'post_author' => get_post_field('post_author', get_the_ID()),
                    'project_type' => get_the_category(get_the_ID()),
                    'project_status' => 85,
                    'solution_gallery' => 1,
                    'galleries' => get_post_gallery(get_the_ID(), false),
                    'versions' => [],
                    'project_urls' => [],
                    'social_networks' => [],
                    'app_stores' => [],
                    'design' => [],
                    'design_gallery' => 2,
                    'design_check_list' => 1,
                    'colors' => [],
                    'logos_icons_gallery' => 3,
                    'uml_diagrams_gallery' => 4,
                    'development' => [],
                    'development_check_list' => 2,
                    'delivery' => [],
                    'delivery_check_list' => 3,
                    'onboarding' => $onboarding,
                    'the_problem' => $the_problem,
                    'project_author' => [
                        'first_name' => get_the_author_meta('user_firstname', $post_author),
                        'last_name' => get_the_author_meta('user_lastname', $post_author),
                        'roles' => get_userdata($post_author)->roles,
                        'linkedin_link' => esc_attr(get_option('linkedin_link')),
                        'hackerrank_link' => esc_attr(get_option('hackerrank_link')),
                        'github_link' => esc_attr(get_option('github_link')),
                    ],
                    'tags' => []
                );

                return rest_ensure_response($post_data, 200);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'Post not found',
                    'status' => $status_code
                ];

                $response = rest_ensure_response($response_data);
                $response->set_status($status_code);

                return $response;
            }
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
