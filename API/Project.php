<?php

namespace THFW_Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use THFW_Portfolio\Post_Types\PortfolioUploads;
use THFW_Portfolio\Database\DatabaseProject;
use THFW_Portfolio\Database\DatabaseOnboarding;
use THFW_Portfolio\Database\DatabaseTheProblem;

class Project
{
    private $post_type;
    private $portfolio_uploads;
    private $project_database;
    private $onboarding_database;
    private $theproblem_database;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->portfolio_uploads = new PortfolioUploads;
        $this->project_database = new DatabaseProject;
        $this->onboarding_database = new DatabaseOnboarding;
        $this->theproblem_database = new DatabaseTheProblem;

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/portfolio', array(
                'methods' => 'POST',
                'callback' => array($this, 'post_project'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_project'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function post_project(WP_REST_Request $request)
    {
        try {
            $project = [
                'client_id' => $request['client_id'],
                'post_id' => $request['post_id'],
                'project_urls' => $request['project_urls'],
                'project_details' => $request['project_details'],
                'project_status' => $request['project_status'],
                'project_versions' => $request['project_versions'],
                'design' => $request['design'],
                'design_check_list' => $request['design'],
                'colors' => $request['colors'],
                'development' => $request['development'],
                'development_check_list' => $request['uml_diagrams'],
                'git_repo' => $request['git_repo'],
                'delivery' => $request['delivery'],
                'delivery_check_list' => $request['delivery_check_list'],
                'project_team' => $request['project_team'],
            ];
            error_log('From update_project' . print_r($project, true));

            $existing_project = $this->project_database->getProject($project['post_id']);

            if ($existing_project) {
                $updated_project = $this->project_database->updateProject($request['post_id'], $project);

                return rest_ensure_response($updated_project, 200);
            } else {
                $project_id = $this->project_database->saveProject($project);
                error_log(print_r($project, true));
                return rest_ensure_response($project_id, 200);
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

            if ($query->have_posts()) {
                $query->the_post();
                $project = $this->project_database->getProject(get_the_ID());
                $onboarding = $this->onboarding_database->getOnboarding($project['id']);
                $the_problem = $this->theproblem_database->getProblem($project['id']);
                error_log(print_r($project, true));
                $post_data = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'post_status' => get_post_field('post_status', get_the_ID()),
                    'post_date' => get_post_field('post_date', get_the_ID()),
                    'solution_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'solution'),
                    'project_urls' => $project['project_urls'],
                    'project_details' => $project['project_details'],
                    'the_solution' => get_post_field('post_content', get_the_ID()),
                    'project_status' => $project['project_status'],
                    'project_versions' => $project['project_versions'],
                    'design' => $project['design'],
                    'design_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'design'),
                    'design_check_list' => $project['design_check_list'],
                    'colors' => $project['colors'],
                    'logos_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'design/logos'),
                    'icons_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'design/icons'),
                    'animations_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'design/animations'),
                    'uml_diagrams_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'design/umldiagrams'),
                    'development' => $project['development'],
                    'development_check_list' => $project['development_check_list'],
                    'git_repo' => $project['git_repo'],
                    'delivery' => $project['delivery'],
                    'delivery_check_list' => $project['delivery_check_list'],
                    'onboarding' => $onboarding,
                    'the_problem' => $the_problem,
                    'project_types' => get_the_category(get_the_ID()),
                    'project_tags' => get_the_tags(get_the_ID()),
                    'project_team' => $project['project_team'],
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
