<?php

namespace SEVEN_TECH_Portfolio\Database;

use Exception;
use Error;

class DatabaseProject
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = 'SEVEN_TECH_Portfolio';
    }

    public function saveProject($project)
    {
        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'client_id' => $project['client_id'],
                'post_id' => $project['post_id'],
                'project_urls_list' => serialize($project['project_urls_list']),
                'project_details_list' => serialize($project['project_details_list']),
                'project_status' => $project['project_status'],
                'project_versions_list' => serialize($project['project_versions_list']),
                'design' => $project['design'],
                'design_check_list' => serialize($project['design_check_list']),
                'colors_list' => serialize($project['colors_list']),
                'development' => $project['development'],
                'development_check_list' => serialize($project['development_check_list']),
                'git_repo' => $project['git_repo'],
                'delivery' => $project['delivery'],
                'delivery_check_list' => serialize($project['delivery_check_list']),
                'project_team_list' => serialize($project['project_team_list']),
            ]
        );

        if (!$result) {
            $error_message = $this->wpdb->last_error;
            throw new Exception($error_message);
        }

        $project_id = $this->wpdb->insert_id;

        return $project_id;
    }

    public function getProject($post_id)
    {
        try {
            $project = $this->wpdb->get_row(
                $this->wpdb->prepare(
                    "SELECT * FROM {$this->table_name} WHERE post_id = %d",
                    $post_id
                )
            );

            if ($project === null) {
                throw new Exception('Project not found', 404);
            }

            $project_data = [
                'id' => $project->id,
                'client_id' => $project->client_id,
                'post_id' => $project->post_id,
                'project_urls_list' => $project->project_urls_list,
                'project_details_list' => $project->project_details_list,
                'project_status' => $project->project_status,
                'project_versions_list' => $project->project_versions_list,
                'design' => $project->design,
                'design_check_list' => $project->design_check_list,
                'colors_list' => $project->colors_list,
                'development' => $project->development,
                'development_check_list' => $project->development_check_list,
                'git_repo' => $project->git_repo,
                'delivery' => $project->delivery,
                'delivery_check_list' => $project->delivery_check_list,
                'project_team_list' => $project->project_team_list,
            ];

            return $project_data;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            return $response;
        }
    }

    public function getProjectByClientID($post_id, $client_id)
    {
        $project = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE post_id = %d AND client_id = %d",
                $post_id,
                $client_id
            )
        );

        if ($project === null) {
            return 'Project not found';
        }

        $project_data = [
            'id' => $project->id,
            'client_id' => $project->client_id,
            'post_id' => $project->post_id,
            'project_urls_list' => $project->project_urls,
            'project_details_list' => $project->project_details,
            'project_status' => $project->project_status,
            'project_versions_list' => $project->project_versions,
            'design' => $project->design,
            'design_check_list' => $project->design_check_list,
            'colors_list' => $project->colors,
            'development' => $project->development,
            'development_check_list' => $project->development_check_list,
            'git_repo' => $project->git_repo,
            'delivery' => $project->delivery,
            'delivery_check_list' => $project->delivery_check_list,
            'project_team_list' => $project->project_team_list,
        ];

        return $project_data;
    }

    public function updateProject($post_id, $project)
    {
        if (isset($project) && is_array($project)) {
            $data = array(
                'client_id' => $project['client_id'],
                'project_urls_list' => serialize($project['project_urls_list']),
                'project_details_list' => serialize($project['project_details_list']),
                'project_status' => $project['project_status'],
                'project_versions_list' => serialize($project['project_versions_list']),
                'design' => $project['design'],
                'design_check_list' => serialize($project['design_check_list']),
                'colors_list' => serialize($project['colors_list']),
                'development' => $project['development'],
                'development_check_list' => serialize($project['development_check_list']),
                'git_repo' => $project['git_repo'],
                'delivery' => $project['delivery'],
                'delivery_check_list' => serialize($project['delivery_check_list']),
                'project_team_list' => serialize($project['project_team_list']),
            );
        } else {
            throw new Exception('Invalid Project Data', 400);
        }

        $where = array(
            'post_id' => $post_id,
        );

        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        global $wpdb;

        if (!empty($data)) {
            $updated = $wpdb->update($this->table_name, $data, $where);

            if ($updated === false) {
                $last_error = $wpdb->last_error;
                throw new Exception('Failed to update project data : ' . $last_error);
            }

            return 'Project updated successfully';
        } else {

            throw new Exception('No valid project data provided for update');
        }
    }
}
