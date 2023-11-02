<?php

namespace SEVEN_TECH_Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use SEVEN_TECH_Portfolio\Post_Types\Portfolio\Uploads;
use SEVEN_TECH_Portfolio\Database\Database;
use SEVEN_TECH_Portfolio\Database\DatabaseProject;
use SEVEN_TECH_Portfolio\Database\DatabaseOnboarding;
use SEVEN_TECH_Portfolio\Database\DatabaseTheProblem;
use SEVEN_TECH_Portfolio\Taxonomies\Taxonomies;

class Project
{
    private $post_type;
    private $portfolio_uploads;
    private $project_database;
    private $onboarding_database;
    private $theproblem_database;
    private $taxonomies;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->portfolio_uploads = new Uploads;
        $database = new Database;

        $this->project_database = new DatabaseProject($database->project_table);
        $this->onboarding_database = new DatabaseOnboarding($database->project_onboarding_table);
        $this->theproblem_database = new DatabaseTheProblem($database->project_problem_table);

        $this->taxonomies = new Taxonomies;

        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/v1', '/portfolio', array(
                'methods' => 'POST',
                'callback' => array($this, 'post_project'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_project'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)/id', array(
                'methods' => 'POST',
                'callback' => array($this, 'get_project_by_client_id'),
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

                    $member = [
                        'id' => $user_data->ID,
                        'first_name' => $user_data->first_name,
                        'last_name' => $user_data->last_name,
                        'email' => $user_data->user_email,
                        'role' => isset($member['role']) ? $member['role'] : '',
                        'author_url' => $user_data->user_url,
                        'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384])
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

                $solution_gallery = $this->portfolio_uploads->getPhotos(get_the_title(), 'solution');
                $design_gallery = $this->portfolio_uploads->getPhotos(get_the_title(), 'design');
                $logos_gallery = $this->portfolio_uploads->getPhotos(get_the_title(), 'design/logos');
                $icons_gallery = $this->portfolio_uploads->getPhotos(get_the_title(), 'design/icons');
                $animations_gallery = $this->portfolio_uploads->getPhotos(get_the_title(), 'design/animations');
                $uml_diagrams_gallery = $this->portfolio_uploads->getPhotos(get_the_title(), 'design/umldiagrams');
                $onboarding = $this->onboarding_database->getOnboarding($project_id);
                $the_problem = $this->theproblem_database->getProblem($project_id);
                $project_types = $this->taxonomies->getTaxTermLinks($project_id, 'project_types');
                $project_tags = $this->taxonomies->getTaxTermLinks($project_id, 'project_tags');

                $project = $this->project_database->getProject($project_id);

                if (is_array($project)) {
                    $project_urls = $project['project_urls'];
                    $project_details = $project['project_details'];
                    $project_status = $project['project_status'];
                    $project_versions = $project['project_versions'];
                    $design = $project['design'];
                    $design_check_list = is_serialized($project['design_check_list']) ? unserialize($project['design_check_list']) : array();
                    $colors = $project['colors'];
                    $development = $project['development'];
                    $development_check_list = is_serialized($project['development_check_list']) ? unserialize($project['development_check_list']) : array();
                    $git_repo = $project['git_repo'];
                    $delivery = $project['delivery'];
                    $delivery_check_list = is_serialized($project['delivery_check_list']) ? unserialize($project['delivery_check_list']) : array();
                    $project_team = $project['project_team'];
                } else {
                    $project_urls = '';
                    $project_details = '';
                    $project_status = '';
                    $project_versions = '';
                    $design = '';
                    $design_check_list = '';
                    $colors = '';
                    $development = '';
                    $development_check_list = '';
                    $git_repo = '';
                    $delivery = '';
                    $delivery_check_list = '';
                    $project_team = '';
                }

                $post_data = [
                    'id' => $project_id,
                    'title' => get_the_title($project_id),
                    'post_status' => get_post_field('post_status', $project_id),
                    'post_date' => get_post_field('post_date', $project_id),
                    'solution_gallery' => is_array($solution_gallery) ? $solution_gallery : '',
                    'project_urls' => $project_urls,
                    'project_details' => $project_details,
                    'the_solution' => get_post_field('post_content', $project_id),
                    'project_status' => $project_status,
                    'project_versions' => $project_versions,
                    'design' => $design,
                    'design_gallery' => is_array($design_gallery) ? $design_gallery : '',
                    'design_check_list' => $design_check_list,
                    'colors' => $colors,
                    'logos_gallery' => is_array($logos_gallery) ? $logos_gallery : '',
                    'icons_gallery' => is_array($icons_gallery) ? $icons_gallery : '',
                    'animations_gallery' => is_array($animations_gallery) ? $animations_gallery : '',
                    'uml_diagrams_gallery' => is_array($uml_diagrams_gallery) ? $uml_diagrams_gallery : '',
                    'development' => $development,
                    'development_check_list' => $development_check_list,
                    'git_repo' => $git_repo,
                    'delivery' => $delivery,
                    'delivery_check_list' => $delivery_check_list,
                    'onboarding' => is_array($onboarding) ? $onboarding : '',
                    'the_problem' => is_array($the_problem) ? $the_problem : '',
                    'project_types' => is_array($project_types) ? $project_types : '',
                    'project_tags' => is_array($project_tags) ? $project_tags : '',
                    'project_team' => is_array($project_team) ? $project_team : '',
                ];

                return rest_ensure_response($post_data);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'Project not found',
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

    public function get_project_by_client_id(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $client_id = $request['client_id'];

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $args = array(
                'post_type' => $this->post_type,
                'name' => $slug,
            );

            $query = new WP_Query($args);

            if ($query->post) {
                $query->the_post();

                $project_id = get_the_ID();

                $project = $this->project_database->getProjectByClientID($project_id, $client_id);

                return rest_ensure_response($project);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'Project not found',
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
