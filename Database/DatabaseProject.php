<?php

namespace THFW_Portfolio\Database;

use Exception;

class DatabaseProject
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = '7tech_portfolio';
    }

    public function saveProject($project)
    {
        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'client_id' => $project['client_id'],
                'post_id' => $project['post_id'],
                'project_urls' => $project['project_urls'],
                'project_details' => $project['project_details'],
                'project_status' => $project['project_status'],
                'project_versions' => $project['project_versions'],
                'design' => $project['design'],
                'design_check_list' => $project['design_check_list'],
                'colors' => $project['colors'],
                'development' => $project['development'],
                'development_check_list' => $project['development_check_list'],
                'git_repo' => $project['git_repo'],
                'delivery' => $project['delivery'],
                'delivery_check_list' => $project['delivery_check_list'],
                'project_team' => $project['project_team'],
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
        $project = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE post_id = %d",
                $post_id
            )
        );

        if ($project === null) {

            throw new Exception('Project not found');
        }

        $project_data = [
            'id' => $project->id,
            'client_id' => $project->client_id,
            'post_id' => $project->post_id,
            'project_urls' => $project->project_urls,
            'project_details' => $project->project_details,
            'project_status' => $project->project_status,
            'project_versions' => $project->project_versions,
            'design' => $project->design,
            'design_check_list' => $project->design_check_list,
            'colors' => $project->colors,
            'development' => $project->development,
            'development_check_list' => $project->development_check_list,
            'git_repo' => $project->git_repo,
            'delivery' => $project->delivery,
            'delivery_check_list' => $project->delivery_check_list,
            'project_team' => $project->project_team,
        ];

        return $project_data;
    }

    public function updateProject($post_id, $project)
    {
        $data = array(
            'client_id' => $project['client_id'],
            'project_urls' => $project['project_urls'],
            'project_details' => $project['project_details'],
            'project_status' => $project['project_status'],
            'project_versions' => $project['project_versions'],
            'design' => $project['design'],
            'design_check_list' => $project['design_check_list'],
            'colors' => $project['colors'],
            'development' => $project['development'],
            'development_check_list' => $project['development_check_list'],
            'git_repo' => $project['git_repo'],
            'delivery' => $project['delivery'],
            'delivery_check_list' => $project['delivery_check_list'],
            'project_team' => $project['project_team'],
        );

        $where = array(
            'post_id' => $post_id,
        );

        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        if (!empty($data)) {
            $updated = $this->wpdb->update($this->table_name, $data, $where);

            if ($updated === false) {

                throw new Exception('Failed to update project data');
            }

            return 'Project updated successfully';
        } else {

            throw new Exception('No valid project data provided for update');
        }
    }
}
