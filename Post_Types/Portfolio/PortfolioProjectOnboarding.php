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
        try {
            if (!is_array($onboarding)) {
                throw new Exception('Project problem data is needed to save to the database.', 400);
            }

            $client_id = $onboarding['client_id'];
            $project_title = $onboarding['project_title'];

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 400);
            }

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

            $onboarding_data = [
                'project_id' => $project_id,
                'project_title' => $project_title,
                'client_id' => $client_id,
                'deadline' => $onboarding['deadline'],
                'deadline_date' => $onboarding['deadline_date'],
                'where_business' => $onboarding['where_business'],
                'website' => $onboarding['website'],
                'website_url' => $onboarding['website_url'],
                'hosting' => $onboarding['hosting'],
                'satisfied' => $onboarding['satisfied'],
                'signage' => $onboarding['signage'],
                'signage_url' => $onboarding['signage_url'],
                'social' => $onboarding['social'],
                'social_facebook' => $onboarding['social_facebook'],
                'social_x' => $onboarding['social_x'],
                'social_linkedin' => $onboarding['social_linkedin'],
                'social_instagram' => $onboarding['social_instagram'],
                'logo' => $onboarding['logo'],
                'logo_url' => $onboarding['logo_url'],
                'colors' => $onboarding['colors'],
                'colors_primary' => $onboarding['colors_primary'],
                'colors_secondary' => $onboarding['colors_secondary'],
                'colors_tertiary' => $onboarding['colors_tertiary'],
                'summary' => $onboarding['summary'],
                'summary_url' => $onboarding['summary_url'],
                'plan' => $onboarding['plan'],
                'plan_url' => $onboarding['plan_url'],
            ];

            $project_data = [
                'project_id' => $project_id,
                'project_title' => $project_title,
                'client_id' => $client_id,
            ];

            $this->project_onboarding->saveOnboarding($onboarding_data);
            $this->portfolio_project->createPortfolioProject($project_data);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at createProjectOnboarding');

            return $response;
        }
    }

    function getProjectOnboarding($project_id)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            $projectOnboarding = $this->project_onboarding->getOnboarding($project_id);

            return $projectOnboarding;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getProjectOnboarding');

            return $response;
        }
    }

    function updateProjectOnboarding($project_id, $onboarding)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            if (!is_array($onboarding)) {
                throw new Exception('Onboarding data is required to update.', 400);
            }

            $projectOnboarding = $this->project_onboarding->updateOnboarding($project_id, $onboarding);

            return $projectOnboarding;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at updateProjectOnboarding');

            return $response;
        }
    }
}
