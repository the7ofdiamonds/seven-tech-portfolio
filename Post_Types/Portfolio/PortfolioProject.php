<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use Exception;

use SEVEN_TECH\Portfolio\Media\Media;
use SEVEN_TECH\Portfolio\Database\DatabaseProject;
use SEVEN_TECH\Portfolio\Database\DatabaseProjectOnboarding;
use SEVEN_TECH\Portfolio\Database\DatabaseProjectProblem;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class PortfolioProject
{
    public $post_type;
    public $media;
    public $project_database;
    public $onboarding_database;
    public $theproblem_database;
    public $taxonomies;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->media = new Media;

        $this->project_database = new DatabaseProject();
        $this->onboarding_database = new DatabaseProjectOnboarding();
        $this->theproblem_database = new DatabaseProjectProblem();

        $this->taxonomies = new Taxonomies;
    }

    function createPortfolioProject($project)
    {
        try {
            if (!is_array($project)) {
                throw new Exception('Project data is needed to save to the database.', 400);
            }

            $project_title = $project['project_title'];
            $project_id = $project['project_id'];

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 400);
            }

            if (empty($project_id)) {
                throw new Exception('Project id is required.', 400);
            }

            $project_page = get_page_by_title($project_title, OBJECT, 'portfolio');

            if (empty($project_page)) {
                throw new Exception('No project found with that title.', 404);
            }

            $project_data = [
                'project_id' => $project_id,
                'project_title' => $project_title,
                'project_slug' => $project_page->post_name,
                'client_id' => !empty($project['client_id']) ? $project['client_id'] : '',
                'deadline' => !empty($project['deadline']) ? $project['deadline'] : '',
                'deadline_date' => !empty($project['deadline_date']) ? $project['deadline_date'] : '',
                'where_business' => !empty($project['where_business']) ? $project['where_business'] : '',
                'website' => !empty($project['website']) ? $project['website'] : '',
                'website_url' => !empty($project['website_url']) ? $project['website_url'] : '',
                'hosting' => !empty($project['hosting']) ? $project['hosting'] : '',
                'satisfied' => !empty($project['satisfied']) ? $project['satisfied'] : '',
                'signage' => !empty($project['signage']) ? $project['signage'] : '',
                'signage_url' => !empty($project['signage_url']) ? $project['signage_url'] : '',
                'social' => !empty($project['social']) ? $project['social'] : '',
                'social_facebook' => !empty($project['social_facebook']) ? $project['social_facebook'] : '',
                'social_x' => !empty($project['social_x']) ? $project['social_x'] : '',
                'social_linkedin' => !empty($project['social_linkedin']) ? $project['social_linkedin'] : '',
                'social_instagram' => !empty($project['social_instagram']) ? $project['social_instagram'] : '',
                'logo' => !empty($project['logo']) ? $project['logo'] : '',
                'logo_url' => !empty($project['logo_url']) ? $project['logo_url'] : '',
                'colors' => !empty($project['colors']) ? $project['colors'] : '',
                'colors_primary' => !empty($project['colors_primary']) ? $project['colors_primary'] : '',
                'colors_secondary' => !empty($project['colors_secondary']) ? $project['colors_secondary'] : '',
                'colors_tertiary' => !empty($project['colors_tertiary']) ? $project['colors_tertiary'] : '',
                'summary' => !empty($project['summary']) ? $project['summary'] : '',
                'summary_url' => !empty($project['summary_url']) ? $project['summary_url'] : '',
                'plan' => !empty($project['plan']) ? $project['plan'] : '',
                'plan_url' => !empty($project['plan_url']) ? $project['plan_url'] : '',
            ];

            $project_id = $this->project_database->saveProject($project_data);

            return $project_id;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at createProjectOnboarding');

            return $response;
        }
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

    function getPortfolioProject($post_id)
    {
        try {
            $project = $this->project_database->getProject($post_id);

            $solution_gallery = $this->media->urls("portfolio/{$post_id}/solution-gallery");
            $design_gallery = $this->media->urls("portfolio/{$post_id}/design-gallery");
            $logos_gallery = $this->media->urls("portfolio/{$post_id}/design-gallery/logos");
            $icons_gallery = $this->media->urls("portfolio/{$post_id}/design-gallery/icons");
            $animations_gallery = $this->media->urls("portfolio/{$post_id}/design-gallery/animations");
            $uml_diagrams_gallery = $this->media->urls("portfolio/{$post_id}/design-gallery/umldiagrams");

            $onboarding = $this->onboarding_database->getOnboarding($post_id);
            $the_problem = $this->theproblem_database->getProblem($post_id);

            $project_types = $this->taxonomies->getTaxTermLinks($post_id, 'project_types');
            $project_tags = $this->taxonomies->getTaxTermLinks($post_id, 'project_tags');

            $team = isset($project['project_team_list']) && is_serialized($project['project_team_list']) ? unserialize($project['project_team_list']) : '';
            $project_team_list = $this->getProjectTeamList($team);

            $project_data = [
                'id' => $post_id,
                'title' => get_the_title($post_id),
                'project_slug' => isset($project['project_slug']) ? $project['project_slug'] : '',
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

    function updatePortfolioProject($project)
    {
        try {
            $project_title = $project['project_title'];

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 400);
            }

            $project_id = $project['project_id'];

            if (empty($project_id)) {
                throw new Exception('Project id is required.', 400);
            }

            if (!is_array($project)) {
                throw new Exception('Project data is needed to save to the database.', 400);
            }

            $page = get_page_by_title($project_title, OBJECT, 'portfolio');

            if (empty($page)) {
                throw new Exception("Project {$project_title} not found.", 404);
            } else {
                $project_slug = $page->post_name;
            }

            $project_data = [
                'project_id' => $project_id,
                'project_title' => $project_title,
                'project_slug' => $project_slug,
                'client_id' => $project['client_id'],
                'deadline' => $project['deadline'],
                'deadline_date' => $project['deadline_date'],
                'where_business' => $project['where_business'],
                'website' => $project['website'],
                'website_url' => $project['website_url'],
                'hosting' => $project['hosting'],
                'satisfied' => $project['satisfied'],
                'signage' => $project['signage'],
                'signage_url' => $project['signage_url'],
                'social' => $project['social'],
                'social_facebook' => $project['social_facebook'],
                'social_x' => $project['social_x'],
                'social_linkedin' => $project['social_linkedin'],
                'social_instagram' => $project['social_instagram'],
                'logo' => $project['logo'],
                'logo_url' => $project['logo_url'],
                'colors' => $project['colors'],
                'colors_primary' => $project['colors_primary'],
                'colors_secondary' => $project['colors_secondary'],
                'colors_tertiary' => $project['colors_tertiary'],
                'summary' => $project['summary'],
                'summary_url' => $project['summary_url'],
                'plan' => $project['plan'],
                'plan_url' => $project['plan_url'],
            ];

            $updatedProject = $this->project_database->updateProject($project_id, $project_data);

            return $updatedProject;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at createProjectOnboarding');

            return $response;
        }
    }
}
