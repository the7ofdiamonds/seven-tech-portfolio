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
                throw new Exception('Project problem data is needed to save to the database.', 400);
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
                    'deadline' => isset($onboarding['deadline']) ? $onboarding['deadline'] : '',
                    'deadline_date' => isset($onboarding['deadline_date']) ? $onboarding['deadline_date'] : '',
                    'where_business' => isset($onboarding['where_business']) ? $onboarding['where_business'] : '',
                    'website' => isset($onboarding['website']) ? $onboarding['website'] : '',
                    'website_url' => isset($onboarding['website_url']) ? $onboarding['website_url'] : '',
                    'hosting' => isset($onboarding['hosting']) ? $onboarding['hosting'] : '',
                    'satisfied' => isset($onboarding['satisfied']) ? $onboarding['satisfied'] : '',
                    'signage' => isset($onboarding['signage']) ? $onboarding['signage'] : '',
                    'signage_url' => isset($onboarding['signage_url']) ? $onboarding['signage_url'] : '',
                    'social' => isset($onboarding['social']) ? $onboarding['social'] : '',
                    'social_facebook' => isset($onboarding['social_facebook']) ? $onboarding['social_facebook'] : '',
                    'social_x' => isset($onboarding['social_x']) ? $onboarding['social_x'] : '',
                    'social_linkedin' => isset($onboarding['social_linkedin']) ? $onboarding['social_linkedin'] : '',
                    'social_instagram' => isset($onboarding['social_instagram']) ? $onboarding['social_instagram'] : '',
                    'logo' => isset($onboarding['logo']) ? $onboarding['logo'] : '',
                    'logo_url' => isset($onboarding['logo_url']) ? $onboarding['logo_url'] : '',
                    'colors' => isset($onboarding['colors']) ? $onboarding['colors'] : '',
                    'colors_primary' => isset($onboarding['colors_primary']) ? $onboarding['colors_primary'] : '',
                    'colors_secondary' => isset($onboarding['colors_secondary']) ? $onboarding['colors_secondary'] : '',
                    'colors_tertiary' => isset($onboarding['colors_tertiary']) ? $onboarding['colors_tertiary'] : '',
                    'summary' => isset($onboarding['summary']) ? $onboarding['summary'] : '',
                    'summary_url' => isset($onboarding['summary_url']) ? $onboarding['summary_url'] : '',
                    'plan' => isset($onboarding['plan']) ? $onboarding['plan'] : '',
                    'plan_url' => isset($onboarding['plan_url']) ? $onboarding['plan_url'] : '',
                ]
            );

            if (!$result) {
                $error_message = $this->wpdb->last_error;
                throw new Exception($error_message);
            }

            $onboarding_id = $this->wpdb->insert_id;

            return $onboarding_id;
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
                throw new Exception('Post ID is required.', 400);
            }

            $onboarding = $this->wpdb->get_row(
                $this->wpdb->prepare(
                    "SELECT * FROM {$this->table_name} WHERE project_id = %d",
                    $project_id
                )
            );

            if (is_object($onboarding)) {
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
            } else {
                throw new Exception('Onboarding not be found.', 404);
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getOnboarding');

            return $response;
        }
    }

    function updateOnboarding($client_id, $onboarding)
    {
        try {
            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            if (!is_object($onboarding)) {
                throw new Exception('Onboarding data is required to update.', 400);
            }

            $data = array(
                'project_id' => $onboarding['project_id'],
                'project_title' => $onboarding['project_title'],
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
                'what_business' => $onboarding['what_business'],
                'plan' => $onboarding['plan'],
                'plan_url' => $onboarding['plan_url'],
            );

            $where = array(
                'client_id' => $client_id,
            );

            if (!empty($data)) {
                $updated = $this->wpdb->update($this->table_name, $data, $where);
            }

            if ($updated === false) {
                throw new Exception('Project onboarding could not be updated.' . $this->wpdb->last_error, 500);
            }

            return $updated;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at updateOnboarding');

            return $response;
        }
    }
}
