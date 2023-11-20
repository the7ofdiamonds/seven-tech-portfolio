<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use SEVEN_TECH\Portfolio\Database\DatabaseProjectOnboarding;

use Exception;

class PortfolioProjectOnboarding
{
    private $project_onboarding;
    private $portfolio_project;

    public function __construct()
    {
        $this->project_onboarding = new DatabaseProjectOnboarding;
        $this->portfolio_project = new PortfolioProject;
    }

    function createProjectOnboarding($onboarding)
    {
        if (!is_array($onboarding)) {
            throw new Exception('Project problem data is needed to save to the database.', 400);
        }

        $project_id = $onboarding['project_id'];
        $project_title = $onboarding['project_title'];
        $client_id = $onboarding['client_id'];

        if (empty($client_id)) {
            throw new Exception('Client ID is required.', 400);
        }

        if (empty($project_title)) {
            throw new Exception('Project title is required.', 400);
        }

        $project = get_page_by_title($project_title, OBJECT, 'portfolio');

        if (empty($project_id) || empty($project)) {
            $project_data = array(
                'post_title'    => $project_title,
                'post_status'   => 'pending',
                'post_author'   => $client_id,
                'post_type'     => 'portfolio',
            );

            $project_id = wp_insert_post($project_data);

            if (is_wp_error($project_id)) {
                throw new Exception('Error creating post: ' . $project_id->get_error_message(), 500);
            }
        }

        $onboarding_data = [
            'project_id' => $project_id,
            'project_title' => $project_title,
            'client_id' => $client_id,
            'deadline' => $onboarding['deadline'],
            'where_business' => $onboarding['where_business'],
            'website' => $onboarding['website'],
            'hosting' => $onboarding['hosting'],
            'satisfied' => $onboarding['satisfied'],
            'signage' => $onboarding['signage'],
            'social_networks' => !empty($onboarding['social_networks']) ? $onboarding['social_networks'] : '',
            'logo' => $onboarding['logo'],
            'colors' => !empty($onboarding['colors']) ? $onboarding['colors'] : '',
            'plan' => $onboarding['plan'],
        ];

        $project_data = [
            'project_id' => $project_id,
            'project_title' => $project_title,
            'client_id' => $client_id,
        ];

        $this->project_onboarding->saveOnboarding($onboarding_data);
        $this->portfolio_project->createPortfolioProject($project_data);
    }

    function getProjectOnboarding($project_id)
    {
        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        $projectOnboarding = $this->project_onboarding->getOnboarding($project_id);

        return $projectOnboarding;
    }

    function updateProjectOnboarding($project_id, $onboarding)
    {
        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        if (!is_array($onboarding)) {
            throw new Exception('Onboarding data is required to update.', 400);
        }

        $projectOnboarding = $this->project_onboarding->updateOnboarding($project_id, $onboarding);

        return $projectOnboarding;
    }
}
