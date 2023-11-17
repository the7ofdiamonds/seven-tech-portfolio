<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use Exception;
use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Uploads;
use SEVEN_TECH\Portfolio\Database\DatabaseProject;
use SEVEN_TECH\Portfolio\Database\DatabaseProjectOnboarding;
use SEVEN_TECH\Portfolio\Database\DatabaseProjectProblem;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class PortfolioProject
{
    public $post_type;
    public $portfolio_uploads;
    public $project_database;
    public $onboarding_database;
    public $theproblem_database;
    public $taxonomies;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->portfolio_uploads = new Uploads;

        $this->project_database = new DatabaseProject();
        $this->onboarding_database = new DatabaseProjectOnboarding();
        $this->theproblem_database = new DatabaseProjectProblem();

        $this->taxonomies = new Taxonomies;
    }

    function createProject(){

    }

    function getProjectStatus($post_id)
    {
        try {
            $project = $this->project_database->getProject($post_id);

            $design_check_list = isset($project['design_check_list']) ? unserialize($project['design_check_list']) : '';
            $development_check_list = isset($project['development_check_list']) ? unserialize($project['development_check_list']) : '';
            $delivery_check_list = isset($project['delivery_check_list']) ? unserialize($project['delivery_check_list']) : '';

            if (is_array($design_check_list) || is_array($development_check_list) || is_array($delivery_check_list)) {
                $design_total_hours = 0;
                $design_completed_hours = 0;

                if (is_array($design_check_list)) {
                    foreach ($design_check_list as $task) {
                        if (isset($task['time'])) {
                            $design_total_hours += (float)$task['time'];

                            if ($task['status'] === 'checked') {
                                $design_completed_hours += (float)$task['time'];
                            } else {
                                continue;
                            }
                        } else {
                            continue;
                        }
                    }
                }

                $development_total_hours = 0;
                $development_completed_hours = 0;

                if (is_array($development_check_list)) {
                    foreach ($development_check_list as $task) {
                        if (isset($task['time'])) {
                            $development_total_hours += (float)$task['time'];

                            if ($task['status'] === 'checked') {
                                $development_completed_hours += (float)$task['time'];
                            } else {
                                continue;
                            }
                        } else {
                            continue;
                        }
                    }
                }


                $delivery_total_hours = 0;
                $delivery_completed_hours = 0;

                if (is_array($delivery_check_list)) {
                    foreach ($delivery_check_list as $task) {
                        if (isset($task['time'])) {
                            $delivery_total_hours += (float)$task['time'];

                            if ($task['status'] === 'checked') {
                                $delivery_completed_hours += (float)$task['time'];
                            } else {
                                continue;
                            }
                        } else {
                            continue;
                        }
                    }
                }

                $total_hours = $design_total_hours + $development_total_hours + $delivery_total_hours;
                $completed_hours = $design_completed_hours + $development_completed_hours + $delivery_completed_hours;

                if ($total_hours > 0 && $completed_hours <= $total_hours) {
                    $decimal = $completed_hours / $total_hours;

                    return number_format($decimal * 100, 2);
                } else {
                    return 0.00;
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            return $response;
        }
    }

    function getProjectTeamList($team)
    {
        $project_team = [];

        if (isset($team) && is_array($team) && !isset($member['id'])) {
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

    function getProject($post_id)
    {
        try {
            $project = $this->project_database->getProject($post_id);

            $solution_gallery = $this->portfolio_uploads->getPhotos(get_the_title($post_id), 'solution');
            $design_gallery = $this->portfolio_uploads->getPhotos(get_the_title($post_id), 'design');
            $logos_gallery = $this->portfolio_uploads->getPhotos(get_the_title($post_id), 'design/logos');
            $icons_gallery = $this->portfolio_uploads->getPhotos(get_the_title($post_id), 'design/icons');
            $animations_gallery = $this->portfolio_uploads->getPhotos(get_the_title($post_id), 'design/animations');
            $uml_diagrams_gallery = $this->portfolio_uploads->getPhotos(get_the_title($post_id), 'design/umldiagrams');

            $onboarding = $this->onboarding_database->getOnboarding($post_id);
            $the_problem = $this->theproblem_database->getProblem($post_id);

            $project_types = $this->taxonomies->getTaxTermLinks($post_id, 'project_types');
            $project_tags = $this->taxonomies->getTaxTermLinks($post_id, 'project_tags');

            $team = isset($project['project_team_list']) && is_serialized($project['project_team_list']) ? unserialize($project['project_team_list']) : '';
            $project_team_list = $this->getProjectTeamList($team);

            $project_data = [
                'id' => $post_id,
                'title' => get_the_title($post_id),
                'post_status' => get_post_field('post_status', $post_id),
                'post_date' => get_post_field('post_date', $post_id),
                'client_id' => isset($project['client_id']) ? $project['client_id'] : '',
                'solution_gallery' => is_array($solution_gallery) ? $solution_gallery : '',
                'project_urls_list' => isset($project['project_urls_list']) && is_serialized($project['project_urls_list']) ? unserialize($project['project_urls_list']) : '',
                'project_details_list' => isset($project['project_details_list']) && is_serialized($project['project_details_list']) ? unserialize($project['project_details_list']) : '',
                'the_solution' => get_post_field('post_content', $post_id),
                'project_status' => isset($project['project_status']) ? $project['project_status'] : '',
                'project_versions_list' => isset($project['project_versions_list']) && is_serialized($project['project_versions_list']) ? unserialize($project['project_versions_list']) : '',
                'design' => isset($project['design']) ? $project['design'] : '',
                'design_gallery' => is_array($design_gallery) ? $design_gallery : '',
                'design_check_list' => isset($project['design_check_list']) && is_serialized($project['design_check_list']) ? unserialize($project['design_check_list']) : '',
                'colors_list' => isset($project['colors_list']) && is_serialized($project['colors_list']) ? unserialize($project['colors_list']) : '',
                'logos_gallery' => is_array($logos_gallery) ? $logos_gallery : '',
                'icons_gallery' => is_array($icons_gallery) ? $icons_gallery : '',
                'animations_gallery' => is_array($animations_gallery) ? $animations_gallery : '',
                'uml_diagrams_gallery' => is_array($uml_diagrams_gallery) ? $uml_diagrams_gallery : '',
                'development' => isset($project['development']) ? $project['development'] : '',
                'development_check_list' => isset($project['development_check_list']) && is_serialized($project['development_check_list']) ? unserialize($project['development_check_list']) : '',
                'git_repo' => isset($project['git_repo']) ? $project['git_repo'] : '',
                'delivery' => isset($project['delivery']) ? $project['delivery'] : '',
                'delivery_check_list' => isset($project['delivery_check_list']) && is_serialized($project['delivery_check_list']) ? unserialize($project['delivery_check_list']) : '',
                'onboarding' => is_array($onboarding) ? $onboarding : '',
                'the_problem' => is_array($the_problem) ? $the_problem : '',
                'project_types' => is_array($project_types) ? $project_types : '',
                'project_tags' => is_array($project_tags) ? $project_tags : '',
                'project_team_list' => $project_team_list,
            ];

            return $project_data;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            return $response;
        }
    }

    function updateProject(){}
}
