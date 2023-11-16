<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use SEVEN_TECH\Portfolio\Database\DatabaseProjectOnboarding;

use Exception;

class PortfolioProjectOnboarding
{
    private $project_onboarding;

    public function __construct()
    {
        $this->project_onboarding = new DatabaseProjectOnboarding;
    }

    function createProjectOnboarding($onboarding)
    {
        try {
            $onboarding_data = [
                'client_id' => $onboarding['client_id'],
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

            $onboarding_id = $this->project_onboarding->saveOnboarding($onboarding_data);
            return $onboarding_id;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            return $response;
        }
    }

}
