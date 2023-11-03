<?php

namespace SEVEN_TECH_Portfolio\Post_Types\Portfolio;

use Exception;
use SEVEN_TECH_Portfolio\Post_Types\Portfolio\Uploads;
use SEVEN_TECH_Portfolio\Database\DatabaseProject;
use SEVEN_TECH_Portfolio\Database\DatabaseOnboarding;
use SEVEN_TECH_Portfolio\Database\DatabaseTheProblem;
use SEVEN_TECH_Portfolio\Taxonomies\Taxonomies;

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
        $this->onboarding_database = new DatabaseOnboarding();
        $this->theproblem_database = new DatabaseTheProblem();

        $this->taxonomies = new Taxonomies;
    }


    function getProjectStatus($post_id)
    {
        try {
            $project = $this->project_database->getProject($post_id);

            $design_check_list = unserialize($project['design_check_list']);
            $development_check_list = unserialize($project['development_check_list']);
            $delivery_check_list = unserialize($project['delivery_check_list']);

            $project_process = [
                $design_check_list,
                $development_check_list, // Fix the variable name here
                $delivery_check_list
            ];

            $total_hours = 0.0;
            $completed_hours = 0.0;

            if (is_array($design_check_list) || is_array($development_check_list) || is_array($delivery_check_list)) {
                foreach ($project_process as $process) {
                    if (is_array($process)) { // Check if $process is an array
                        foreach ($process as $task) {
                            if (isset($task['time'])) {
                                $total_hours += (float)$task['time'];
                            }
                        }
                    }
                }

                foreach ($project_process as $process) {
                    if (is_array($process)) { // Check if $process is an array
                        foreach ($process as $i => $task) {
                            if (isset($task['status']) && isset($task['time'])) {
                                if ($task['status'] === 'checked') {
                                    $completed_hours += (float)$task['time'];
                                }
                            }
                        }
                    }
                }

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

            $project_data = [
                'id' => $post_id,
                'title' => get_the_title($post_id),
                'post_status' => get_post_field('post_status', $post_id),
                'post_date' => get_post_field('post_date', $post_id),
                'client_id' => isset($project['client_id']) ? $project['client_id'] : '',
                'solution_gallery' => is_array($solution_gallery) ? $solution_gallery : '',
                'project_urls' => isset($project['project_urls']) ? $project['project_urls'] : '',
                'project_details' => isset($project['project_details']) ? $project['project_details'] : '',
                'the_solution' => get_post_field('post_content', $post_id),
                'project_status' => isset($project['project_status']) ? $project['project_status'] : '',
                'project_versions' => isset($project['project_versions']) ? $project['project_versions'] : '',
                'design' => isset($project['design']) ? $project['design'] : '',
                'design_gallery' => is_array($design_gallery) ? $design_gallery : '',
                'design_check_list' => isset($project['design_check_list']) && is_serialized($project['design_check_list']) ? unserialize($project['design_check_list']) : '',
                'colors' => isset($project['colors']) ? $project['colors'] : '',
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
                'project_team' => isset($project['project_team']) ? $project['project_team'] : '',
            ];

            return $project_data;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            return $response;
        }
    }
}
