<?php

namespace SEVEN_TECH_Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use SEVEN_TECH_Portfolio\Post_Types\Portfolio\Uploads;
use SEVEN_TECH_Portfolio\Database\DatabaseProject;
use SEVEN_TECH_Portfolio\Database\DatabaseTeam;
use SEVEN_TECH_Portfolio\Database\DatabaseOnboarding;
use SEVEN_TECH_Portfolio\Database\DatabaseTheProblem;

class Project
{
    private $post_type;
    private $portfolio_uploads;
    private $project_database;
    private $team_database;
    private $onboarding_database;
    private $theproblem_database;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->portfolio_uploads = new Uploads;
        $this->project_database = new DatabaseProject;
        $this->team_database = new DatabaseTeam;
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
                'design_check_list' => $request['design_check_list'],
                'colors' => $request['colors'],
                'development' => $request['development'],
                'development_check_list' => $request['development_check_list'],
                'git_repo' => $request['git_repo'],
                'delivery' => $request['delivery'],
                'delivery_check_list' => $request['delivery_check_list'],
                'project_team' => serialize($request['project_team']),
            ];

            $existing_project = $this->project_database->getProject($project['post_id']);

            if ($existing_project) {
                $updated_project = $this->project_database->updateProject($request['post_id'], $project);

                return rest_ensure_response($updated_project, 200);
            } else {
                $project_id = $this->project_database->saveProject($project);

                return rest_ensure_response($project_id);
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

    function get_project_team($team)
    {
        $project_team = [];

        if (isset($team) && is_array($team)) {
            foreach ($team as $member) {
                $user_data = get_userdata($member['id']);

                if ($user_data) {
                    $team_data = $this->team_database->getMember($user_data->ID);

                    $member = [
                        'id' => $user_data->ID,
                        'first_name' => $user_data->first_name,
                        'last_name' => $user_data->last_name,
                        'email' => $user_data->user_email,
                        'role' => isset($member['role']) ? $member['role'] : '',
                        'avatar_url' => isset($team_data['avatar_url']) ? $team_data['avatar_url'] : get_avatar_url($user_data->ID, ['size' => 384]),
                        'author_url' => isset($team_data['author_url']) ? $team_data['author_url'] : '',
                    ];

                    $project_team[] = $member;
                }
            }
        }

        return $project_team;
    }


    public function get_project(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $args = array(
                'post_type' => $this->post_type,
                'name' => $slug,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $query->the_post();

                $project_id = get_the_ID();
                $project = $this->project_database->getProject($project_id);
                $project_team = $this->get_project_team(unserialize($project['project_team']));

                $post_data = array(
                    'id' => $project_id,
                    'title' => get_the_title($project_id),
                    'post_status' => get_post_field('post_status', $project_id),
                    'post_date' => get_post_field('post_date', $project_id),
                    'solution_gallery' => $this->portfolio_uploads->getPhotos(get_the_title(), 'solution'),
                    'project_urls' => $project['project_urls'],
                    'project_details' => $project['project_details'],
                    'the_solution' => get_post_field('post_content', $project_id),
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
                    'onboarding' => $this->onboarding_database->getOnboarding($project_id),
                    'the_problem' => $this->theproblem_database->getProblem($project_id),
                    'project_types' => wp_get_post_terms($project_id, 'project_types', array('fields' => 'all')),
                    'project_tags' => wp_get_post_terms($project_id, 'project_tags', array('fields' => 'all')),
                    'project_team' => isset($project_team) ? $project_team : '',
                );

                return rest_ensure_response($post_data);
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
