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
        if (!is_array($onboarding)) {
            throw new Exception('Project ondoarding data is needed to save to the database.', 400);
        }

        $project_id = $onboarding['project_id'] ?? '';
        $project_title = $onboarding['project_title'] ?? '';
        $client_id = $onboarding['client_id'] ?? '';

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
                'where_business' => !empty($onboarding['where_business']) ? $onboarding['where_business'] : '',
                'website' => !empty($onboarding['website']) ? $onboarding['website'] : '',
                'hosting' => !empty($onboarding['hosting']) ? $onboarding['hosting'] : '',
                'satisfied' => !empty($onboarding['satisfied']) ? $onboarding['satisfied'] : '',
                'signage' => !empty($onboarding['signage']) ? $onboarding['signage'] : '',
                'social_networks' => !empty($onboarding['social_networks']) ? serialize($onboarding['social_networks']) : '',
                'logo' => !empty($onboarding['logo']) ? $onboarding['logo'] : '',
                'colors' => !empty($onboarding['colors']) ? serialize($onboarding['colors']) : '',
                'plan' => !empty($onboarding['plan']) ? $onboarding['plan'] : '',
            ]
        );

        if (!$result) {
            $error_message = $this->wpdb->last_error;
            throw new Exception($error_message);
        }

        return [
            'id' => $this->wpdb->insert_id,
            'message' => 'Project onboarding saved successfully.'
        ];
    }

    function getOnboarding($project_id)
    {
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
            return ['message' => 'To better serve your needs and wants, please fill out the onboarding form.'];
        }

        $onboarding_data = [
            'id' => $onboarding->id,
            'project_id' => $onboarding->project_id,
            'project_title' => $onboarding->project_title,
            'client_id' => $onboarding->client_id,
            'deadline' => $onboarding->deadline,
            'where_business' => $onboarding->where_business,
            'website' => $onboarding->website,
            'hosting' => $onboarding->hosting,
            'satisfied' => $onboarding->satisfied,
            'signage' => $onboarding->signage,
            'social_networks' => unserialize($onboarding->social_networks),
            'logo' => $onboarding->logo,
            'colors' => unserialize($onboarding->colors),
            'plan' => $onboarding->plan,
        ];

        return $onboarding_data;
    }

    function updateOnboarding($project_id, $onboarding)
    {
        if (empty($project_id)) {
            throw new Exception('Project ID is required.', 400);
        }

        if (!is_array($onboarding)) {
            throw new Exception('Invalid project onboarding data.', 400);
        }

        $project_title = $onboarding['project_title'] ?? '';
        $client_id = $onboarding['client_id'] ?? '';

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
            'deadline' => !empty($onboarding['deadline']) ? $onboarding['deadline'] : '',
            'where_business' => !empty($onboarding['where_business']) ? $onboarding['where_business'] : '',
            'website' => !empty($onboarding['website']) ? $onboarding['website'] : '',
            'hosting' => !empty($onboarding['hosting']) ? $onboarding['hosting'] : '',
            'satisfied' => !empty($onboarding['satisfied']) ? $onboarding['satisfied'] : '',
            'signage' => !empty($onboarding['signage']) ? $onboarding['signage'] : '',
            'social_networks' => !empty($onboarding['social_networks']) ? serialize($onboarding['social_networks']) : '',
            'logo' => !empty($onboarding['logo']) ? $onboarding['logo'] : '',
            'colors' => !empty($onboarding['colors']) ? serialize($onboarding['colors']) : '',
            'plan' => !empty($onboarding['plan']) ? $onboarding['plan'] : '',
        );

        $where = array(
            'project_id' => $project_id,
        );

        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        $updated_rows = $this->wpdb->update($this->table_name, $data, $where);

        if ($updated_rows == 0) {
            throw new Exception('Project onboarding was not updated; no changes were saved. ' . $this->wpdb->last_error, 500);
        }

        return [
            'results' => $updated_rows,
            'message' => 'Project onboarding updated successfully.'
        ];
    }
}
