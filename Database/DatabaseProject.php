<?php

namespace SEVEN_TECH\Portfolio\Database;

use Exception;

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

    function saveProject($project)
    {
        try {
            if (!is_array($project)) {
                throw new Exception('Project data is needed to save to the database.', 400);
            }

            $project_id = !empty($project['project_id']) ? $project['project_id'] : '';
            $project_title = !empty($project['project_title']) ? $project['project_title'] : '';
            $project_slug = !empty($project['project_slug']) ? $project['project_slug'] : '';
            $client_id = !empty($project['client_id']) ? $project['client_id'] : '';

            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 404);
            }

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 404);
            }

            if (empty($project_slug)) {
                throw new Exception('Project slug is required.', 404);
            }

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 404);
            }

            $result = $this->wpdb->insert(
                $this->table_name,
                [
                    'project_id' => $project_id,
                    'project_title' => $project_title,
                    'project_slug' => $project_slug,
                    'client_id' => $client_id,
                    'project_urls_list' => !empty($project['project_urls_list']) ? serialize($project['project_urls_list']) : '',
                    'project_details_list' => !empty($project['project_details_list']) ? serialize($project['project_details_list']) : '',
                    'project_status' => !empty($project['project_status']) ? $project['project_status'] : '',
                    'project_versions_list' => !empty($project['project_versions_list']) ? serialize($project['project_versions_list']) : '',
                    'design' => !empty($project['design']) ? $project['design'] : '',
                    'design_check_list' => !empty($project['design_check_list']) ? serialize($project['design_check_list']) : '',
                    'colors_list' => !empty($project['colors_list']) ? serialize($project['colors_list']) : '',
                    'development' => !empty($project['development']) ? $project['development'] : '',
                    'development_check_list' => !empty($project['development_check_list']) ? serialize($project['development_check_list']) : '',
                    'git_repo' => !empty($project['git_repo']) ? $project['git_repo'] : '',
                    'delivery' => !empty($project['delivery']) ? $project['delivery'] : '',
                    'delivery_check_list' => !empty($project['delivery_check_list']) ? serialize($project['delivery_check_list']) : '',
                    'project_team_list' => !empty($project['project_team_list']) ? serialize($project['project_team_list']) : '',
                ]
            );

            if (!$result) {
                throw new Exception('Failed to save the project. ' . $this->wpdb->last_error, 500);
            }

            return [
                'id' => $this->wpdb->insert_id,
                'message' => 'Project saved successfully'
            ];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at saveProject');

            return $response;
        }
    }

    function getProject($project_id)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            $project = $this->wpdb->get_row(
                $this->wpdb->prepare(
                    "SELECT * FROM {$this->table_name} WHERE project_id = %d",
                    $project_id
                )
            );

            if (!is_object($project)) {
                return ['message' => 'Project not found'];
            }

            $project_data = [
                'id' => $project->id,
                'project_id' => $project->project_id,
                'project_title' => $project->project_title,
                'project_slug' => $project->project_slug,
                'client_id' => $project->client_id,
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

            error_log($response . ' at getProject');

            return $response;
        }
    }

    function getProjectByClientID($project_id, $client_id)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $project = $this->wpdb->get_row(
                $this->wpdb->prepare(
                    "SELECT * FROM {$this->table_name} WHERE project_id = %d AND client_id = %d",
                    $project_id,
                    $client_id
                )
            );

            if (!is_object($project)) {
                return ['message' => 'Project could not be found'];
            }

            $project_data = [
                'id' => $project->id,
                'project_id' => $project->project_id,
                'project_title' => $project->project_title,
                'project_slug' => $project->project_slug,
                'client_id' => $project->client_id,
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
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getProjectByClientID');

            return $response;
        }
    }

    function updateProject($project_id, $project)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            if (!is_array($project)) {
                throw new Exception('Invalid Project Data', 400);
            }

            $project_title = $project['project_title'];

            $project = get_page_by_title($project_title, OBJECT, 'portfolio');

            if (empty($project)) {
                throw new Exception('Project could not be found.', 404);
            } else {
                $project_slug = $project->post_name;
            }

            $data = array(
                'project_title' => $project_title,
                'project_slug' => $project_slug,
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

            $where = array(
                'project_id' => $project_id,
            );

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });

            $updated_rows = $this->wpdb->update($this->table_name, $data, $where);

            if ($updated_rows == 0) {
                throw new Exception('Failed to update project data : ' . $this->wpdb->last_error);
            }

            return [
                'project_slug' => $project_slug,
                'results' => $updated_rows,
                'message' => 'Project updated successfully'
            ];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at updateProject');

            return $response;
        }
    }
}
