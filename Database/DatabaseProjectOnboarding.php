<?php

namespace SEVEN_TECH\Portfolio\Database;

use Exception;

class DatabaseProjectOnboarding
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = 'SEVEN_TECH_Portfolio_project_onboarding';
    }

    function saveOnboarding($onboarding)
    {
        try {
            if (!is_array($onboarding)) {
                throw new Exception('Invalid project problem data.', 400);
            }

            $project_id = $onboarding['project_id'];
            $project_title = $onboarding['project_title'];
            $client_id = $onboarding['client_id'];

            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 400);
            }

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $result = $this->wpdb->insert(
                $this->table_name,
                [
                    'project_id' => $project_id,
                    'project_title' => $project_title,
                    'client_id' => $client_id,
                    'deadline' => !empty($onboarding['deadline']) ? $onboarding['deadline'] : '',
                    'deadline_date' => !empty($onboarding['deadline_date']) ? $onboarding['deadline_date'] : '',
                    'where_business' => !empty($onboarding['where_business']) ? $onboarding['where_business'] : '',
                    'website' => !empty($onboarding['website']) ? $onboarding['website'] : '',
                    'website_url' => !empty($onboarding['website_url']) ? $onboarding['website_url'] : '',
                    'hosting' => !empty($onboarding['hosting']) ? $onboarding['hosting'] : '',
                    'satisfied' => !empty($onboarding['satisfied']) ? $onboarding['satisfied'] : '',
                    'signage' => !empty($onboarding['signage']) ? $onboarding['signage'] : '',
                    'signage_url' => !empty($onboarding['signage_url']) ? $onboarding['signage_url'] : '',
                    'social' => !empty($onboarding['social']) ? $onboarding['social'] : '',
                    'social_facebook' => !empty($onboarding['social_facebook']) ? $onboarding['social_facebook'] : '',
                    'social_x' => !empty($onboarding['social_x']) ? $onboarding['social_x'] : '',
                    'social_linkedin' => !empty($onboarding['social_linkedin']) ? $onboarding['social_linkedin'] : '',
                    'social_instagram' => !empty($onboarding['social_instagram']) ? $onboarding['social_instagram'] : '',
                    'logo' => !empty($onboarding['logo']) ? $onboarding['logo'] : '',
                    'logo_url' => !empty($onboarding['logo_url']) ? $onboarding['logo_url'] : '',
                    'colors' => !empty($onboarding['colors']) ? $onboarding['colors'] : '',
                    'colors_primary' => !empty($onboarding['colors_primary']) ? $onboarding['colors_primary'] : '',
                    'colors_secondary' => !empty($onboarding['colors_secondary']) ? $onboarding['colors_secondary'] : '',
                    'colors_tertiary' => !empty($onboarding['colors_tertiary']) ? $onboarding['colors_tertiary'] : '',
                    'summary' => !empty($onboarding['summary']) ? $onboarding['summary'] : '',
                    'summary_url' => !empty($onboarding['summary_url']) ? $onboarding['summary_url'] : '',
                    'plan' => !empty($onboarding['plan']) ? $onboarding['plan'] : '',
                    'plan_url' => !empty($onboarding['plan_url']) ? $onboarding['plan_url'] : '',
                ]
            );

            if (!$result) {
                $error_message = $this->wpdb->last_error;
                throw new Exception($error_message);
            }

            return $this->wpdb->insert_id;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at saveOnboarding');

            return $response;
        }
    }

    function getOnboarding($project_id)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            $onboarding = $this->wpdb->get_row(
                $this->wpdb->prepare(
                    "SELECT * FROM {$this->table_name} WHERE project_id = %d",
                    $project_id
                )
            );

            if (!is_object($onboarding)) {
                throw new Exception('Project onboarding could not be found.', 404);
            }

            $onboarding_data = [
                'id' => $onboarding->id,
                'project_id' => $onboarding->project_id,
                'project_title' => $onboarding->project_title,
                'client_id' => $onboarding->client_id,
                'deadline' => $onboarding->deadline,
                'deadline_date' => $onboarding->deadline_date,
                'where_business' => $onboarding->where_business,
                'website' => $onboarding->website,
                'website_url' => $onboarding->website_url,
                'hosting' => $onboarding->hosting,
                'satisfied' => $onboarding->satisfied,
                'signage' => $onboarding->signage,
                'signage_url' => $onboarding->signage_url,
                'social' => $onboarding->social,
                'social_facebook' => $onboarding->social_facebook,
                'social_x' => $onboarding->social_x,
                'social_linkedin' => $onboarding->social_linkedin,
                'social_instagram' => $onboarding->social_instagram,
                'logo' => $onboarding->logo,
                'logo_url' => $onboarding->logo_url,
                'colors' => $onboarding->colors,
                'colors_primary' => $onboarding->colors_primary,
                'colors_secondary' => $onboarding->colors_secondary,
                'colors_tertiary' => $onboarding->colors_tertiary,
                'summary' => $onboarding->summary,
                'summary_url' => $onboarding->summary_url,
                'plan' => $onboarding->plan,
                'plan_url' => $onboarding->plan_url,
            ];

            return $onboarding_data;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getOnboarding');

            return $response;
        }
    }

    function updateOnboarding($project_id, $onboarding)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            if (!is_array($onboarding)) {
                throw new Exception('Invalid project onboarding data.', 400);
            }

            $project_title = $onboarding['project_title'];
            $client_id = $onboarding['client_id'];

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 400);
            }

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $data = array(
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
                'what_business' => $onboarding['what_business'],
                'plan' => $onboarding['plan'],
                'plan_url' => $onboarding['plan_url'],
            );

            $where = array(
                'project_id' => $project_id,
            );

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });

            $updated = $this->wpdb->update($this->table_name, $data, $where);

            if ($updated === false) {
                throw new Exception('Failed to update project onboarding.' . $this->wpdb->last_error, 500);
            }

            return 'Project onboarding updated successfully.';
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at updateOnboarding');

            return $response;
        }
    }
}
